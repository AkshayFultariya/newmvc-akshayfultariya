<?php

class Controller_Product extends Controller_Core_Action
{


	public function gridAction()
	{
		try {
			$this->getMessage()->getSession()->start();
			$layout = $this->getLayout();
			$grid = $layout->createBlock('Product_Grid');
			$layout->getChild('content')->addChild('grid',$grid);
			$layout->render();
		} catch (Exception $e) {
	    	$this->getMessage()->addMessage('Currently Products not avilable',Model_Core_Message :: FAILURE);
			
		}
        	
	}


	public function addAction()
	{
		try {
        	$this->getMessage()->getSession()->start();

			$layout = $this->getLayout();
			$product = Ccc::getModel('Product');
        	$edit = $layout->createBlock('Product_Edit')->setData(['product'=>$product]);
			$layout->getChild('content')->addChild('edit',$edit);
			$layout->render();
		} catch (Exception $e) {
			$this->getMessage()->addMessage('Product not showed.',Model_Core_Message :: FAILURE);
		}
		
	}

	public function editAction()
	{
		try {
	        $this->getMessage()->getSession()->start();
			$productId = (int) Ccc::getModel('Core_Request')->getParam('id');
			if (!$productId) {
				throw new Exception("Invalid Id", 1);
				
			}
			$layout = $this->getLayout();
			$product = Ccc::getModel('Product')->load($productId);
			// Ccc::log($product,'a.log');
			if (!$product) {
				throw new Exception("Invalid Id", 1);
				
			}
			$edit = $layout->createBlock('Product_Edit')->setData(['product'=>$product]);

			$layout->getChild('content')->addChild('edit',$edit);
			$layout->render();
		} catch (Exception $e) {
			$this->getMessage()->addMessage('Product not showed.',Model_Core_Message :: FAILURE);
		}

	}

	public function saveAction()
	{
		try {
       		$this->getMessage()->getSession()->start();

			if (!$this->getRequest()->isPost()) {
				// echo "111";
				throw new Exception("Invalid request.", 1);
			}

			$postData = $this->getRequest()->getpost('product');

			// print_r($postData);

			if (!$postData) {
				throw new Exception("Invalid data posted.", 1);
			}

			if ($id = (int)$this->getRequest()->getParam('id')) {
				$product = Ccc::getModel('Product')->load($id);

				if (!$product) {
					throw new Exception("Invalid id.", 1);
				}
			$product->updated_at = date("Y-m-d H:i:s");
			}
			else{
				$product = Ccc::getModel('Product');
				$product->created_at = date("Y-m-d H:i:s");
			}
			$product->setData($postData);

			if (!$product->save()) {
				throw new Exception("Unable to save product.", 1);
			}
		    $this->getMessage()->addMessage('Product has been sucessfully.',Model_Core_Message :: SUCCESS);


		} catch (Exception $e) {
		    $this->getMessage()->addMessage($e->getMessage(),Model_Core_Message :: FAILURE);
			
		}
		$this->redirect('product','grid',null,true);
	}

	public function deleteAction()
	{
		try {
			$this->getMessage()->getSession()->start();
			if (!($id = (int) $this->getRequest()->getParam('id'))) {
			throw new Exception("Error Processing Request", 1);
			
		}
		$product = Ccc::getModel('Product')->load($id);

		if (!$product) {
			throw new Exception("Error Processing Request", 1);
		}

		$product->delete();

	    $this->getMessage()->addMessage('Product deleted sucessfully.',Model_Core_Message :: SUCCESS);


	}catch(Exception $e){
		$this->getMessage()->addMessage('Product not deleted.',Model_Core_Message :: FAILURE);
	}
		$this->redirect('product','grid',null,true);
	}





}
