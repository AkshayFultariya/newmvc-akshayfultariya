<?php

class Controller_Product_Media extends Controller_Core_Action
{

	public function gridAction()
	{
		try {
			Ccc::getModel('Core_Session')->start();
			$productId = Ccc::getModel('Core_Request')->getParam('id');
			if (!$productId) {
				throw new Exception("Id not found", 1);
			}
			Ccc::register('product_id',$productId);

			$layout = $this->getLayout();
			$grid = $layout->createBlock('Product_Media_Grid');
			$medias = $grid->getMedias();
			if ($medias) {
			$medias = $grid->getMedias()->getData();
			}
			$layout->getChild('content')->addChild('grid',$grid);
			echo $layout->toHtml();

		} catch (Exception $e) {
			$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
		}
	}

	public function addAction()
	{
		try {
			Ccc::getModel('Core_Session')->start();
			$productId = Ccc::getModel('Core_Request')->getParam('id');
			Ccc::register('product_id',$productId);
			$media = Ccc::getModel('Product_Media');
			$layout = $this->getLayout();
			$add = $layout->createBlock('Product_Media_Edit')->setData(['product_id'=>$productId,'media'=>$media]);
			// $add = new Block_Product_Media_Edit();
			$layout->getChild('content')->addChild('add',$add);
			echo $layout->toHtml();

		} catch (Exception $e) {
			$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
		}
	}	
	
	public function saveAction()
	{
		try {
			Ccc::getModel('Core_Session')->start();
			if (!Ccc::getModel('Core_Request')->isPost()) {
				throw new Exception("Invalid Request", 1);
			}

			$productId = Ccc::getModel('Core_Request')->getParam('id');
			if (!$productId) {
				throw new Exception("ID not found.", 1);
			}

			$mediaPostData = Ccc::getModel('Core_Request')->getPost();
			if (array_key_exists('submit', $mediaPostData)) {

				$productMedia = Ccc::getModel('Core_Request')->getPost();
				$baseId = $productMedia['base'];
				$thumbnailId = $productMedia['thumbnail'];
				$smallId = $productMedia['small'];
				$galleryId = $productMedia['gallery'];

				$mediaIds['base'] = 0;
				$mediaIds['thumbnail'] = 0;
				$mediaIds['small'] = 0;
				$mediaIds['gallery'] = 0;

				$mediaPost = Ccc::getModel('Product_Media');
				$sql = "SELECT `media_id` FROM `media` WHERE `product_id` = {$productId}";
				$id = $mediaPost->fetchAll($sql)->getData();
				// print_r($id);
				// die();

				foreach($id as $key => $value)
				{	
					$ids[] = $value->getData('media_id');
				}

				foreach($ids as $key => $value)
				{
					$mediaIds['media_id'] = $value;
					$mediaPost->setData($mediaIds);
					$result = $mediaPost->save();
					$mediaPost->removeData();
					if ($result) {
						$this->getMessage()->addMessage('Product media saved Successfully.');
					}
				}
				$base['base'] = 1;
				$base['media_id'] = $baseId;
				// $postData = $this->getRequest()->getpost('product');
				$i = Ccc::getModel('Product')->load($productId);
				$i->base_id = $base['media_id'];
				$i->save();
				$mediaPost->setData($base);
				$productMedia = $mediaPost->save();
				$mediaPost->removeData();
				if ($productMedia) {
					$this->getMessage()->addMessage('Product media saved Successfully.');
				}
				
				$thumbnail['thumbnail'] = 1;
				$thumbnail['media_id'] = $thumbnailId;
				// $i = Ccc::getModel('Product');
				$i->thumbnail_id = $thumbnail['media_id'];
				$i->save();
				// $i->setData($thumbnail);
				$mediaPost->setData($thumbnail);
				$productMedia = $mediaPost->save();
				$mediaPost->removeData();
				if ($productMedia) {
					$this->getMessage()->addMessage('Product media saved Successfully.');
				}

				$small['small'] = 1;
				$small['media_id'] = $smallId;
				// $i = Ccc::getModel('Product');
				$i->small_id = $small['media_id'];
				$i->save();
				// print_r($i);
				// die();
				// $i->setData($postData);
				$mediaPost->setData($small);
				$productMedia = $mediaPost->save();
				$mediaPost->removeData();			
				if ($productMedia) {
					$this->getMessage()->addMessage('Product media saved Successfully.');
				}

				$gallery['gallery'] = 1;
				foreach ($galleryId as $key => $value) {
					$gallery['media_id'] = $value;
					$mediaPost->setData($gallery);
					$productMedia = $mediaPost->save();
					$mediaPost->removeData();
				}

				if ($productMedia) {
					$this->getMessage()->addMessage('Product media saved Successfully.');
				}
				
			}  else {
				$mediaPost = Ccc::getModel('Product_Media');
				$mediaPost->setData($mediaPostData['media']);
				$mediaPost->created_at = date('Y-m-d h-i-sA');
				$mediaPost->product_id = $productId;

				$result = $mediaPost->save();
				$mediaId = $mediaPost->media_id;

				$fileName = $_FILES['media']['name']['image'];
				$tmpName = $_FILES['media']['tmp_name']['image'];

				$stringArray = explode('.', $fileName);
				$extension = $stringArray[1];

				$fileName = $mediaId.'.'.$extension;
				$destination = 'view/product/media/upload/'.$fileName;
				$result = move_uploaded_file($tmpName, $destination);

				$mediaPost->image = $fileName;
				$mediaPost->media_id = $mediaId;
				$productMedia = $mediaPost->save();
				if (!$productMedia) {
					throw new Exception("Product Media not saved Successfully.", 1);
				}else{
					$this->getMessage()->addMessage('Product Media saved Successfully.');
				}
			}

		} catch (Exception $e) {
			$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);			
		}
		$this->redirect('product_media','grid', null);

	}


	public function deleteAction()
	{
		try {
			Ccc::getModel('Core_Session')->start();
			$productId = Ccc::getModel('Core_Request')->getParam('id');
			if (!$productId) {
				throw new Exception("ID not found.", 1);
			}

			$mediaId = Ccc::getModel('Core_Request')->getParam('id');
			if (!$mediaId) {
				throw new Exception("ID not found.", 1);
			}

			$media = Ccc::getModel('Product_Media');
			$media->load($productId);
			$media->load($mediaId);
			$productMedia = $media->delete();
			if (!$productMedia) {
				throw new Exception("data not deleted", 1);
			} else {
				$this->getMessage()->addMessage('data deleted.');
			}
			
		} catch (Exception $e) {
			$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
		}
		
		$this->redirect('product_media','grid', ['product_id' => $productId, 'media_id' => null]);

	}

}


?>