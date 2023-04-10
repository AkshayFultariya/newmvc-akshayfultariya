<?php

class Controller_Payment extends Controller_Core_Action
{
	public function gridAction()
	{
		try {

			$this->getMessage()->getSession()->start();
			$layout = $this->getLayout();
			$grid = $layout->createBlock('Payment_Grid');
			$layout->getChild('content')->addChild('grid',$grid);
			$layout->render();

		} catch (Exception $e) {
		    $this->getMessage()->addMessage('Payments not avilable',Model_Core_Message :: FAILURE);
			
		}
		
	}

	public function addAction()
	{
		try {
        	$this->getMessage()->getSession()->start();

			$layout = $this->getLayout();
			$add = $layout->createBlock('Payment_Edit');

			$layout->getChild('content')->addChild('content',$add);
			$layout->render();
		} catch (Exception $e) {
			$this->getMessage()->addMessage('Payment not showed.',Model_Core_Message :: FAILURE);
		}
		
	}

	public function editAction()
	{
		try {
	        $this->getMessage()->getSession()->start();

			$layout = $this->getLayout();
			$edit = $layout->createBlock('Payment_Edit');


			$layout->getChild('content')->addChild('content',$edit);
			$layout->render();
		} catch (Exception $e) {
			$this->getMessage()->addMessage('Payment not showed.',Model_Core_Message :: FAILURE);
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

			$postData = $this->getRequest()->getpost('payment');

			if (!$postData) {
				throw new Exception("Invalid data posted.", 1);
			}

			if ($id = (int)$this->getRequest()->getParam('payment_method_id')) {
				$payment = Ccc::getModel('Payment')->load($id);

				if (!$payment) {
					throw new Exception("Invalid id.", 1);
				}
			$payment->updated_at = date("Y-m-d H:i:s");
			}
			else{
				$payment = Ccc::getModel('Payment');
				$payment->created_at = date("Y-m-d H:i:s");
			}
			$payment->setData($postData);

			if (!$payment->save()) {
				throw new Exception("Unable to save payment.", 1);
			}
		    $this->getMessage()->addMessage('Payment updeted sucessfully.',Model_Core_Message :: SUCCESS);


		} catch (Exception $e) {
		    $this->getMessage()->addMessage('Invalid.',Model_Core_Message :: FAILURE);
			
		}
		$this->redirect('payment','grid',null,true);
	}

	public function deleteAction()
	{
		try {
			$this->getMessage()->getSession()->start();
			if (!($id = (int) $this->getRequest()->getParam('payment_method_id'))) {
			throw new Exception("Error Processing Request", 1);
			
			}
			$payment = Ccc::getModel('Payment')->load($id);

			if (!$payment) {
				throw new Exception("Error Processing Request", 1);
			}

			$payment->delete();
			$this->getMessage()->addMessage('Payment deleted sucessfully.',Model_Core_Message :: SUCCESS);

		}catch(Exception $e){
			$this->getMessage()->addMessage('Payment not deleted.',Model_Core_Message :: FAILURE);
		}
			$this->redirect('payment','grid',null,true);
	}





}
