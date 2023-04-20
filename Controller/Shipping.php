<?php

class Controller_Shipping extends Controller_Core_Action
{

	public function gridAction()
	{
		try {
			$this->getMessage()->getSession()->start();
			$layout = $this->getLayout();
			$grid = $layout->createBlock('Shipping_Grid');
			$layout->getChild('content')->addChild('grid',$grid);
			$layout->render();
		} catch (Exception $e) {
	    	$this->getMessage()->addMessage('Currently Shippings not avilable',Model_Core_Message :: FAILURE);
			
		}
        	
	}


	public function addAction()
	{
		try {
        	$this->getMessage()->getSession()->start();

			$layout = $this->getLayout();
			$shipping = Ccc::getModel('Shipping');
        	$edit = $layout->createBlock('Shipping_Edit')->setData(['shipping'=>$shipping]);
			$layout->getChild('content')->addChild('edit',$edit);
			$layout->render();
		} catch (Exception $e) {
			$this->getMessage()->addMessage('Shipping not showed.',Model_Core_Message :: FAILURE);
		}
		
	}

	public function editAction()
	{
		try {
	        $this->getMessage()->getSession()->start();
			$shippingId = (int) Ccc::getModel('Core_Request')->getParam('id');
			if (!$shippingId) {
				throw new Exception("Invalid Id", 1);
				
			}
			$layout = $this->getLayout();
			$shipping = Ccc::getModel('shipping')->load($shippingId);
			if (!$shipping) {
				throw new Exception("Invalid Id", 1);
				
			}
			$edit = $layout->createBlock('shipping_Edit')->setData(['shipping'=>$shipping]);

			$layout->getChild('content')->addChild('edit',$edit);
			$layout->render();
		} catch (Exception $e) {
			$this->getMessage()->addMessage('Shipping not showed.',Model_Core_Message :: FAILURE);
		}

	}


	public function saveAction()
	{
		try {
			
		
		if (!$this->getRequest()->isPost()) {
			throw new Exception("Invalid Id", 1);
		}
		$shippingData = $this->getRequest()->getPost();

		if (!$shippingData) {
			throw new Exception("Invalid data posted", 1);
		}

		if ($id = $this->getRequest()->getParam('id')) {
			$shipping = Ccc::getModel('Shipping');
			$shipping->load($id);
			$shipping->updated_at = date("Y-m-d H-i-s"); 
		}
		else{
			$shipping = Ccc::getModel('Shipping');
			// $shipping->entity_type_id = $shipping::ENTITY_TYPE_ID;
			$shipping->created_at = date("Y-m-d H-i-s"); 
		}

		$shipping->setData($shippingData['shipping']);
		
		if (!$shipping->save()) {
			throw new Exception("Unable to save", 1);
		}
		else{

		$attributeData = $this->getRequest()->getPost('attribute');
		// echo "<pre>";
		// print_r($attributeData);
		// die();

		$queries = [];
		foreach ($attributeData as $backendType => $value) {

			foreach ($value as $attributeId => $v) {
				if (is_array($v)) {
					$v = implode(",", $v);
				}

				$model = Ccc::getModel('Core_Table');
				$resource = $model->getResource()->setResourceName("shipping_{$backendType}")->setPrimaryKey('value_id');
				$query = "INSERT INTO `shipping_{$backendType}` (`shipping_id`,`attribute_id`,`value`) VALUES ('{$shipping->getId()}','{$attributeId}','{$v}') ON DUPLICATE KEY UPDATE `value` = '{$v}'";

				$id = $model->getResource()->getAdapter()->query($query);


		
			}
		}
		} 
	}catch (Exception $e) {
		    $this->getMessage()->addMessage('Invalid.',Model_Core_Message :: FAILURE);
			
		}
		$this->redirect('shipping','grid',null,true);
	}

	

	

	public function deleteAction()

		{
		try {
			$this->getMessage()->getSession()->start();
			if (!($id = (int) $this->getRequest()->getParam('id'))) {
			throw new Exception("Error Processing Request", 1);
			
		}
		$shipping = Ccc::getModel('Shipping')->load($id);

		if (!$shipping) {
			throw new Exception("Error Processing Request", 1);
		}

		$shipping->delete();

		$this->redirect('shipping','grid',null,true);

		$this->getMessage()->addMessage('Shipping deleted sucessfully.',Model_Core_Message :: SUCCESS);

	}catch(Exception $e){
		$this->getMessage()->addMessage('Shipping not deleted.',Model_Core_Message :: FAILURE);
	}
	}
}



