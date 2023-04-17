<?php

class Controller_Customer extends Controller_Core_Action
{

	public function testAction()
	{
		$data = Ccc::getModel('Customer')->getShippingId();
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
			$billingAddress = Ccc::getModel('Customer');
			$shippingAddress = Ccc::getModel('Customer');
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
			if (!$customerId) {
				throw new Exception("Invalid Id", 1);
				
			}
			$layout = $this->getLayout();
			$customer = Ccc::getModel('Customer')->load($customerId);
			if (!$customer) {
				throw new Exception("Invalid Id", 1);
			}
			$billingAddress = Ccc::getModel('Customer')->getBillingAddress();
			$shippingAddress = Ccc::getModel('Customer')->getShippingAddress();
			// print_r($billingAddress);
			// die();
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

	public function saveAction()
	{
		try {
       		Ccc::getModel('Core_Session')->start();
			if (!Ccc::getModel('Core_Request')->isPost()) {
				throw new Exception("Invalid request.", 1);
			}
			
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
			// 	print_r($customer);
				$customer->created_at = date('Y-m-d h-i-sA');
					
			}

			$customer->setData($customerPost);
			if (!$customer->save()) {
				throw new Exception("customer data not saved.", 1);
			}
			else{
					// die();
				$addressPostBilling = Ccc::getModel('Core_Request')->getPost('billingAddress');
				if (!$addressPostBilling) {
					throw new Exception("Data not found.", 1);
				}
				if ($id = (int) Ccc::getModel('Core_Request')->getParam('id')) {
					$addressBilling = Ccc::getModel('customer')->getBillingAddress();
					// print_r($addressBilling);
			        // die();  
					if (!$addressBilling) {
						throw new Exception("Data not found.", 1);
					}
					$addressBilling->address_id = $customer->customer_id;
				} else {
					$addressBilling = Ccc::getModel('customer_Address');
					$addressBilling->customer_id = $customer->customer_id;
				}
				$addressPostShipping= Ccc::getModel('Core_Request')->getPost('shippingAddress');
				if (!$addressPostShipping) {
					throw new Exception("Data not found.", 1);
				}

				$addressBilling->setData($addressPostBilling);

				// print_r($addressBilling->save());
				// 	echo "<br>";
				// 	die();
				$billingSave = $addressBilling->save();
				// print_r($billingSave->address_id);
				// var_dump($billingSave);
				// die();
				if (!$billingSave) {
					throw new Exception("customer data not saved.", 1);
				}

				if ($id = (int) Ccc::getModel('Core_Request')->getParam('id')) {
					$addressShipping = Ccc::getModel('customer')->getShippingAddress();
					if (!$addressShipping) {
						throw new Exception("Data not found.", 1);
					}
					$addressShipping->address_id = $customer->customer_id;
				} else {
					$addressShipping = Ccc::getModel('customer_Address');
					$addressShipping->customer_id = $customer->customer_id;
					}

				$addressShipping->setData($addressPostShipping);
				// $address->setData($addressPostShipping);
				$shippingSave = $addressShipping->save();
			// 	print_r($shippingSave);
			// die();
				if (!$shippingSave) {
					throw new Exception("customer data not saved.", 1);
				}
				// die();
			// $customer = Ccc::getModel('customer');

			$customer->billing_address_id = $billingSave->address_id;
			$customer->shipping_address_id = $shippingSave->address_id;
			$customer->save();
			}
			$this->getMessage()->addMessage('customer data saved Successfully.');
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

