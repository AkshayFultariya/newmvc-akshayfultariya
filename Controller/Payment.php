<?php

class Controller_Payment extends Controller_Core_Action
{
	public function indexAction()
	{
		$layout = $this->getLayout();
		$index = $layout->createBlock('Core_Template')->setTemplate('payment_method/index.phtml');
		$layout->getChild('content')->addChild('index',$index);
		$this->renderLayout();
    }

	public function gridAction()
	{
		try {

			$grid = $this->getLayout()->createBlock('Payment_Grid');
			if ($this->getRequest()->isPost()) {
				if ($recordPerPage = (int) $this->getRequest()->getPost('selectRecordPerPage')) {
					$grid->getPager()->setRecordPerPage($recordPerPage);
				}
			}
			$grid = $grid->toHtml();
			$this->getResponse()->jsonResponse(['html'=>$grid,'element'=>'content-html']);

		} catch (Exception $e) {
		    $this->getMessage()->addMessage('Payments not avilable',Model_Core_Message :: FAILURE);
			
		}
		
	}

	public function addAction()
	{
		try {

			$layout = $this->getLayout();
			$payment = Ccc::getModel('payment');
        	$add = $layout->createBlock('Payment_Edit')->setData(['payment'=>$payment])->toHtml();
			$this->getResponse()->jsonResponse(['html'=>$add,'element'=>'content-html']);
		} catch (Exception $e) {
			$this->getMessage()->addMessage('Payment not showed.',Model_Core_Message :: FAILURE);
		}
		
	}

	public function editAction()
	{
		try {
			$paymentId = (int) Ccc::getModel('Core_Request')->getParam('id');
			if (!$paymentId) {
				throw new Exception("Invalid Id", 1);
				
			}
			$layout = $this->getLayout();
			$payment = Ccc::getModel('Payment')->load($paymentId);
			if (!$payment) {
				throw new Exception("Invalid Id", 1);
				
			}
			$edit = $layout->createBlock('Payment_Edit')->setData(['payment'=>$payment])->toHtml();
			$this->getResponse()->jsonResponse(['html'=>$edit,'element'=>'content-html']);
			
		} catch (Exception $e) {
			$this->getMessage()->addMessage('Payment not showed.',Model_Core_Message :: FAILURE);
		}

	}

	public function saveAction()
	{
		try {
			
			
			if (!$this->getRequest()->isPost()) {
				throw new Exception("Invalid Id", 1);
			}
			$paymentData = $this->getRequest()->getPost();

			if (!$paymentData) {
				throw new Exception("Invalid data posted", 1);
			}

			if ($id = $this->getRequest()->getParam('id')) {
				$payment = Ccc::getModel('payment');
				$payment->load($id);
				$payment->updated_at = date("Y-m-d H-i-s"); 
			}
			else{
				$payment = Ccc::getModel('payment');
				// $payment->entity_type_id = $payment::ENTITY_TYPE_ID;
				$payment->created_at = date("Y-m-d H-i-s"); 
			}
			$payment->setData($paymentData['payment']);
			
			if (!$payment->save()) {
				throw new Exception("Unable to save", 1);
			}
			else{

			$attributeData = $this->getRequest()->getPost('attribute');

			$queries = [];
			foreach ($attributeData as $backendType => $value) {

				foreach ($value as $attributeId => $v) {
					if (is_array($v)) {
						$v = implode(",", $v);
					}

					$model = Ccc::getModel('Core_Table');
					$resource = $model->getResource()->setResourceName("payment_{$backendType}")->setPrimaryKey('value_id');
					$query = "INSERT INTO `payment_{$backendType}` (`payment_method_id`,`attribute_id`,`value`) VALUES ('{$payment->getId()}','{$attributeId}','{$v}') ON DUPLICATE KEY UPDATE `value` = '{$v}'";

					$id = $model->getResource()->getAdapter()->query($query);
					}
				}
			}
			$layout = $this->getLayout();
			$grid = $layout->createBlock('Payment_Grid')->toHtml();
			$this->getResponse()->jsonResponse(['html'=>$grid,'element'=>'content-html']);
		}  catch (Exception $e) {
		    $this->getMessage()->addMessage('Invalid.',Model_Core_Message :: FAILURE);
			
		}
	}

	public function deleteAction()
	{
		try {
			$this->getMessage()->getSession()->start();
			if (!($id = (int) $this->getRequest()->getParam('id'))) {
			throw new Exception("Error Processing Request", 1);
			
			}
			$payment = Ccc::getModel('Payment')->load($id);

			if (!$payment) {
				throw new Exception("Error Processing Request", 1);
			}

			$payment->delete();
			$this->getMessage()->addMessage('Payment deleted sucessfully.',Model_Core_Message :: SUCCESS);

			$layout = $this->getLayout();
			$grid = $layout->createBlock('Payment_Grid')->toHtml();
			$this->getResponse()->jsonResponse(['html'=>$grid,'element'=>'content-html']);

		}catch(Exception $e){
			$this->getMessage()->addMessage('Payment not deleted.',Model_Core_Message :: FAILURE);
		}
	}





}
