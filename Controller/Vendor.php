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
			$add = $layout->createBlock('Vendor_Edit');
			$layout->getChild('content')->addChild('content',$add);
			$layout->render();
		} catch (Exception $e) {
			$this->getMessage()->addMessage('Currently vendors not avilable',Model_Core_Message :: FAILURE);
		}
	}

	public function editAction()
	{
		try {
			$this->getMessage()->getSession()->start();

			$layout = $this->getLayout();
			$edit = $layout->createBlock('Vendor_Edit');

			$layout->getChild('content')->addChild('content',$edit);
			$layout->render();
		} catch (Exception $e) {
			 $this->getMessage()->addMessage('data not showed',Model_Core_Message :: FAILURE);
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

			$postData = $this->getRequest()->getpost('vendor');
			if (!$postData) {
				throw new Exception("Invalid data posted.", 1);
			}
			$postDataAddress = $this->getRequest()->getpost('address');
			if (!$postDataAddress) {
				throw new Exception("Invalid data posted.", 1);
			}
			if ($id = (int)$this->getRequest()->getParam('vendor_id')) {
				$vendor = Ccc::getModel('Vendor')->load($id);
				$vendorAddress = Ccc::getModel('Vendor_Address')->load($id);

				if (!$vendor) {
					throw new Exception("Invalid id.", 1);
				}
			$vendor->updated_at = date("Y-m-d H:i:s");
			}
			else{
				$vendor = Ccc::getModel('Vendor');
				$vendorAddress = Ccc::getModel('Vendor_Address');
				$vendor->created_at = date("Y-m-d H:i:s");
			}
			$vendor->setData($postData);
			if (!$vendor->save()) {
				throw new Exception("Unable to save vendor.", 1);
			}
			$vendorAddress->setData($postDataAddress);
			if (!$vendorAddress->save()) {
				throw new Exception("Unable to save vendor.", 1);
			}

		    $this->getMessage()->addMessage('Vendor updeted sucessfully.',Model_Core_Message :: SUCCESS);


		} catch (Exception $e) {
		    $this->getMessage()->addMessage('Invalid.',Model_Core_Message :: FAILURE);
			
		}
		$this->redirect('vendor','grid',null,true);
	}

	public function deleteAction()
	{
		try {
			$this->getMessage()->getSession()->start();
			$this->getMessage()->getSession()->start();
			if (!($id = (int) $this->getRequest()->getParam('vendor_id'))) {
			throw new Exception("Error Processing Request", 1);
			
		}
		$vendor = Ccc::getModel('Vendor')->load($id);

		if (!$vendor) {
			throw new Exception("Error Processing Request", 1);
		}

		$vendor->delete();

		$this->getMessage()->addMessage('Vendor deleted sucessfully.',Model_Core_Message :: SUCCESS);
		}catch(Exception $e){
			$this->getMessage()->addMessage('Vendor not deleted.',Model_Core_Message :: FAILURE);
		}
		$this->redirect('vendor','grid',null,true);
	}

}


