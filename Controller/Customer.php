<?php

class Controller_Customer extends Controller_Core_Action
{

	public function testAction()
	{
		$data = Ccc::getModel('Customer')->getBillingId();
		print_r($data);



		die();

	}
	public function gridAction()
	{
		try {
			$this->getMessage()->getSession()->start();
			$layout = $this->getLayout();
			$grid = $layout->createBlock('Customer_Grid');
			$layout->getChild('content')->addChild('grid',$grid);
			$layout->render();
		} catch (Exception $e) {
			$this->getMessage()->addMessage('Currently customers not avilable',Model_Core_Message :: FAILURE);
			
		}
	   
	}

	public function addAction()
	{
		try {
        	$this->getMessage()->getSession()->start();

        	$layout = $this->getLayout();
			$customer = Ccc::getModel('Customer');
			$billingAddress = Ccc::getModel('Customer_Address');
			$shippingAddress = Ccc::getModel('Customer_Address');
        	$edit = $layout->createBlock('Customer_Edit')->setData(['customer'=>$customer,'billingAddress'=>$billingAddress,'shippingAddress' =>$shippingAddress]);
			$layout->getChild('content')->addChild('edit',$edit);
			$layout->render();
			
		} catch (Exception $e) {
			$this->getMessage()->addMessage('data not showed',Model_Core_Message :: FAILURE);
		}
	}

	public function editAction()
	{
		try {
			$this->getMessage()->getSession()->start();
			$customerId = (int) Ccc::getModel('Core_Request')->getParam('id');
			// die();
			if (!$customerId) {
				throw new Exception("Invalid Id", 1);
				
			}
			$layout = $this->getLayout();
			$customer = Ccc::getModel('Customer')->load($customerId);
			if (!$customer) {
				throw new Exception("Invalid Id", 1);
			// print_r($customerId);
			}
			$billingAddress = Ccc::getModel('Customer_Address')->load($customerId);
			
			// die();
			$shippingAddress = Ccc::getModel('Customer_Address')->load($customerId);
			if (!$billingAddress) {
				throw new Exception("Invalid Id", 1);
			}
			$edit = $layout->createBlock('Customer_Edit')->setData(['customer'=>$customer,'billingAddress' => $billingAddress,'shippingAddress' => $shippingAddress]);

			$layout->getChild('content')->addChild('edit',$edit);
			$layout->render();


			
			
		} catch (Exception $e) {
			 $this->getMessage()->addMessage('data not showed',Model_Core_Message :: FAILURE);
		}
		
		
	}

	public function saveShippingAddress($customer)
	{
		// if ($this->getRequest()->getPost()) {
		// 	// code...
		// }

		$shippingPostData = $this->getRequest()->getPost('shippingAddress');

		// print_r($shippingPostData);
// die();
		if (!$shippingPostData) {
			throw new Exception("Error Processing Request", 1);
		}
		$shippingAddress = $customer->getShippingAddress();
		if (!$shippingAddress) {
			$shippingAddress = Ccc::getModel('Customer_Address');
			$shippingAddress->customer_id = $customer->customer_id;
		}

		$shippingAddress->setData($shippingPostData);
			// die();
		// print_r($shippingAddress->save());
		// die();
		if (!$shippingAddress->save()) {
			throw new Exception("Error Processing Request", 1);
		}
		return $shippingAddress;
	}

	public function saveBillingAddress($customer)
	{
		// if ($this->getRequest()->getPost()) {
		// 	// code...
		// }

		$billingPostData = $this->getRequest()->getPost('billingAddress');

		if (!$billingPostData) {
			throw new Exception("Error Processing Request", 1);
		}
		$billingAddress = $customer->getBillingAddress();
// die();
		if (!$billingAddress) {
			$billingAddress = Ccc::getModel('Customer_Address');
			$billingAddress->customer_id = $customer->customer_id;
		}

		$billingAddress->setData($billingPostData);

		if (!$billingAddress->save()) {
			throw new Exception("Error Processing Request", 1);
		}
		return $billingAddress;
	}

	public function saveCustomer()
	{
			$customerPost = Ccc::getModel('Core_Request')->getPost('customer');
			// print_r($customerPost);
			// die();
			if (!$customerPost) {
				throw new Exception("Data not found.", 1);
			}

			if ($id = (int) Ccc::getModel('Core_Request')->getParam('id')) {
				$customer = Ccc::getModel('customer')->load($id);
				if (!$customer) {
					throw new Exception("Data not found.", 1);
				}
				$customer->updated_at = date('Y-m-d h-i-sA');
			} else {
				$customer = Ccc::getModel('customer');
				$customer->created_at = date('Y-m-d h-i-sA');
			}

			$customer->setData($customerPost);
			if (!$customer->save()) {
				throw new Exception("customer data not saved.", 1);
			}
			else{
				return $customer;
			}
	}

	public function saveAction()
	{
		try {
       		Ccc::getModel('Core_Session')->start();
			if (!Ccc::getModel('Core_Request')->isPost()) {
				throw new Exception("Invalid request.", 1);
			}

			$customer = $this->saveCustomer();
			$shippingAddress = $this->saveShippingAddress($customer);
			// echo "<pre>";
			// print_r($customer);
			// die();
			$billingAddress = $this->saveBillingAddress($customer);

			$customer->billing_address_id = $billingAddress->address_id;
			$customer->shipping_address_id = $shippingAddress->address_id;

			unset($customer->updated_at);
			$customer = $customer->save();
			// var_dump($customer);
			// die();
			
			
			if (!$customer) {
				throw new Exception("customer data not saved.", 1);
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
				$resource = $model->getResource()->setResourceName("customer_{$backendType}")->setPrimaryKey('value_id');
				$query = "INSERT INTO `customer_{$backendType}` (`customer_id`,`attribute_id`,`value`) VALUES ('{$customer->getId()}','{$attributeId}','{$v}') ON DUPLICATE KEY UPDATE `value` = '{$v}'";

				$id = $model->getResource()->getAdapter()->query($query);
				}
			}
		}
		} catch (Exception $e) {
			$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
		}
		
		$this->redirect('customer', 'grid', [], true);
	}

	public function deleteAction()
	{
	    try {
	    	$this->getMessage()->getSession()->start();
				if (!($id = (int) $this->getRequest()->getParam('id'))) {
				throw new Exception("Error Processing Request", 1);
				
			}
			$customer = Ccc::getModel('Customer')->load($id);
			if (!$customer->delete()) {
				throw new Exception("Error Processing Request", 1);
			}
			$address = Ccc::getModel('Customer_Address')->load($id);
			if (!$address->delete()) {
				throw new Exception("Error Processing Request", 1);
			}
		$customer->delete();
		$this->getMessage()->addMessage('Customer updeted sucessfully.',Model_Core_Message :: SUCCESS);

		}catch(Exception $e){
			$this->getMessage()->addMessage('data not deleted',Model_Core_Message :: FAILURE);
		}
		$this->redirect('customer','grid',null,true);
	}
}

