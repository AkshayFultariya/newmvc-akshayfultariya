<?php

class Controller_Eav_Attribute extends Controller_Core_Action
{
	
	public function gridAction()
	{
		// $attribute = Ccc::getModel('Eav_Attribute');
		// $query = "SELECT * FROM `eav_attribute`";
		// $data = $attribute->fetchAll($query);
		// echo "<pre>";
		// print_r($data);
		// die();

		$this->getMessage()->getSession()->start();
			$layout = $this->getLayout();
			$grid = new Block_Eav_Attribute_Grid();
			$layout->getChild('content')->addChild('grid',$grid);
			$layout->render();
	}

	public function addAction()
	{
		try {
        	// $this->getMessage()->getSession()->start();
        	// $add = new Block_Eav_Attribute_Edit();
        	// $layout = $this->getLayout();
			// $layout->getChild('content')->addChild('content',$add);
			// $layout->render();
			$this->getMessage()->getSession()->start();

			$layout = $this->getLayout();
			$attribute = Ccc::getModel('Eav_Attribute');
        	$edit = $layout->createBlock('Eav_Attribute_Edit')->setData(['attribute'=>$attribute]);
			$layout->getChild('content')->addChild('edit',$edit);
			$layout->render();
		} catch (Exception $e) {
			$this->getMessage()->addMessage('Eav_Attribute not showed.',Model_Core_Message :: FAILURE);
		}
		
	}

	public function editAction()
	{
		try {
			$this->getMessage()->getSession()->start();
			$attributeId = (int) Ccc::getModel('Core_Request')->getParam('attribute_id');
        	$layout = $this->getLayout();
        	$attribute = Ccc::getModel('Eav_Attribute')->load($attributeId);
        	// echo "<pre>";
        	// print_r($attribute);
        	// die();
        	$edit = $layout->createBlock('Eav_Attribute_Edit')->setData(['attribute'=>$attribute]);
        	$layout->getChild('content')->addChild('edit',$edit);
        	$layout->render();
			
		} catch (Exception $e) {
			$this->getMessage()->addMessage('Eav_Attribute not showed.',Model_Core_Message :: FAILURE);
		}
	}

	public function saveAction()
	{
		$this->getMessage()->getSession()->start();

			if (!$this->getRequest()->isPost()) {
				throw new Exception("Invalid request.", 1);
			}

			$postData = $this->getRequest()->getpost();
			// echo "<pre>";
			// print_r($postData);
			// die();
			if (!$postData) {
				throw new Exception("Invalid data posted.", 1);
			}

			if ($id = (int)$this->getRequest()->getParam('attribute_id')) {
				$attribute = Ccc::getModel('Eav_Attribute')->load($id);

			// echo "<pre>";
			// print_r($attribute);
			// die();
				if (!$attribute) {
					throw new Exception("Invalid id.", 1);
				}
			}
			else{
				$attribute = Ccc::getModel('Eav_Attribute');
			}
			$attribute->setData($postData['attribute']);
			// $final = $a->save();
			// var_dump($final);


			if (!$attribute->save()) {
				throw new Exception("Unable to save attribute.", 1);
			}
			else
			{
				$attributeId = $attribute->attribute_id;
				// print_r(expression)
				if (array_key_exists('exits',$postData['option'])) {
					$query = "SELECT * FROM `eav_attribute_option` WHERE `attribute_id` = $attributeId";
					$attributeModel = Ccc::getModel('Eav_Attribute_Option');
					$attributeOption = $attributeModel->fetchAll($query);
					if ($attributeOption) {
						foreach ($attributeOption->getData() as $row) {
							if (!array_key_exists($row->option_id,$postData['option']['exits'])) {
								$row->setData(['option_id' => $row->option_id]);
								if (!$row->delete()) {
									throw new Exception("Error Processing Request", 1);
									
								}
							}
						}
					}
				}
				if (array_key_exists('new',$postData['option'])) {
					foreach ($postData['option']['new'] as $postData) {
						$option['name'] = $postData;
						$option['attribute_id'] = $attributeId;
						$attributeOption = Ccc::getModel('Eav_Attribute_Option');
						$attributeOption->setData($option);
						$attributeOption->save();
						unset($option);
					}
				}

			}
		    $this->getMessage()->addMessage('Attribute has been sucessfully.',Model_Core_Message :: SUCCESS);
		    $this->redirect('eav_attribute','grid',null,true);
	}
}

?>