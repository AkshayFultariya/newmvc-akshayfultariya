<?php

class Controller_Vendor extends Controller_Core_Action
{
	public function gridAction()
	{
		try {
			$this->getMessage()->getSession()->start();

			$layout = $this->getLayout();
			$grid = $layout->createBlock('Vendor_Grid');
			$layout->getChild('content')->addChild('grid',$grid);
			$layout->render();
			
		} catch (Exception $e) {
			$this->getMessage()->addMessage('Currently vendors not avilable',Model_Core_Message :: FAILURE);
			
		}
	}

	public function addAction()
	{
		try {
        	$this->getMessage()->getSession()->start();

        	$layout = $this->getLayout();
			$vendor = Ccc::getModel('Vendor');
			$address = Ccc::getModel('Vendor_Address');
        	$edit = $layout->createBlock('Vendor_Edit')->setData(['vendor'=>$vendor,'address'=>$address]);
			$layout->getChild('content')->addChild('edit',$edit);
			$layout->render();
		} catch (Exception $e) {
			$this->getMessage()->addMessage('Currently vendors not avilable',Model_Core_Message :: FAILURE);
		}
	}

	public function editAction()
	{
		try {
			$this->getMessage()->getSession()->start();
			$vendorId = (int) Ccc::getModel('Core_Request')->getParam('id');
			if (!$vendorId) {
				throw new Exception("Invalid Id", 1);
				
			}
			$layout = $this->getLayout();
			$vendor = Ccc::getModel('Vendor')->load($vendorId);
			if (!$vendor) {
				throw new Exception("Invalid Id", 1);
			}
			$address = Ccc::getModel('Vendor_Address')->load($vendorId);
			if (!$address) {
				throw new Exception("Invalid Id", 1);
			}
			$edit = $layout->createBlock('Vendor_Edit')->setData(['vendor'=>$vendor,'address' => $address]);

			$layout->getChild('content')->addChild('edit',$edit);
			$layout->render();
		} catch (Exception $e) {
			 $this->getMessage()->addMessage('data not showed',Model_Core_Message :: FAILURE);
		}
		
	}

	public function saveAction()
	{
		try {
			Ccc::getModel('Core_Session')->start();
			if (!Ccc::getModel('Core_Request')->isPost()) {
				throw new Exception("Invalid request.", 1);
			}
			
			$vendorPost = Ccc::getModel('Core_Request')->getPost();
			// print_r($vendorPost);
			// die();
			if (!$vendorPost) {
				throw new Exception("Data not found.", 1);
			}

			if ($id = (int) Ccc::getModel('Core_Request')->getParam('id')) {
				$vendor = Ccc::getModel('Vendor')->load($id);
				if (!$vendor) {
					throw new Exception("Data not found.", 1);
				}
				$vendor->updated_at = date('Y-m-d h-i-sA');
			} else {
				$vendor = Ccc::getModel('Vendor');
				$vendor->created_at = date('Y-m-d h-i-sA');
			}

			$vendor->setData($vendorPost['vendor']);
			if (!$vendor->save()) {
				throw new Exception("Vendor data not saved.", 1);
			}
			else{
				$addressPost = Ccc::getModel('Core_Request')->getPost();
				if (!$addressPost) {
					throw new Exception("Data not found.", 1);
				}

				if ($id = (int) Ccc::getModel('Core_Request')->getParam('id')) {
					$address = Ccc::getModel('Vendor_Address')->load($id);
					if (!$address) {
						throw new Exception("Data not found.", 1);
					}
					$address->address_id = $vendor->vendor_id;
				} else {
					$address = Ccc::getModel('Vendor_Address');
					// print_r($address);
					$address->vendor_id = $vendor->vendor_id;
				}

				$address->setData($addressPost['address']);
				if (!$address->save()) {
					throw new Exception("Vendor data not saved.", 1);
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
				$resource = $model->getResource()->setResourceName("vendor_{$backendType}")->setPrimaryKey('value_id');
				$query = "INSERT INTO `vendor_{$backendType}` (`vendor_id`,`attribute_id`,`value`) VALUES ('{$vendor->getId()}','{$attributeId}','{$v}') ON DUPLICATE KEY UPDATE `value` = '{$v}'";

				$id = $model->getResource()->getAdapter()->query($query);
				}
			}
		}
	}
}
		 catch (Exception $e) {
			$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
		}
		
		$this->redirect('vendor', 'grid', [], true);
	}

	public function deleteAction()
	{
		try {
			$this->getMessage()->getSession()->start();
			
			if (!($id = (int) $this->getRequest()->getParam('id'))) {
				throw new Exception("Error Processing Request", 1);
			
			}
			$vendor = Ccc::getModel('Vendor')->load($id);

			if (!$vendor->delete()) {
				throw new Exception('Vendor not deleted.', 1);
			}

			$this->getMessage()->addMessage('Vendor deleted sucessfully.',Model_Core_Message :: SUCCESS);

		}catch(Exception $e){
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message :: FAILURE);
		}
		$this->redirect('vendor','grid',null,true);
	}

}


