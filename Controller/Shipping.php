<?php

class Controller_Shipping extends Controller_Core_Action
{

	public function indexAction()
	{
		$layout = $this->getLayout();
		$index = $layout->createBlock('Core_Template')->setTemplate('shipping_method/index.phtml');
		$layout->getChild('content')->addChild('index',$index);
		$this->renderLayout();
	}

	public function gridAction()
	{
		try {
			$layout = $this->getLayout();
			$grid = $layout->createBlock('Shipping_Grid')->toHtml();
			$this->getResponse()->jsonResponse(['html'=>$grid,'element'=>'content-html']);
		} catch (Exception $e) {
	    	$this->getMessage()->addMessage('Currently Shippings not avilable',Model_Core_Message :: FAILURE);
		}
	}


	public function addAction()
	{
		try {
			$layout = $this->getLayout();
			$shipping = Ccc::getModel('Shipping');
        	$add = $layout->createBlock('Shipping_Edit')->setData(['shipping'=>$shipping])->toHtml();
        	// echo json_encode(['html'=>$add,'element'=>'content-html']);
			// @header("content-type:application/json");
			$this->getResponse()->jsonResponse(['html'=>$add,'element'=>'content-html']);
			// die();
		} catch (Exception $e) {
			$this->getMessage()->addMessage('Shipping not showed.',Model_Core_Message :: FAILURE);
		}
		
	}

	public function editAction()
	{
		try {
			$shippingId = (int) Ccc::getModel('Core_Request')->getParam('id');
			if (!$shippingId) {
				throw new Exception("Invalid Id", 1);
				
			}
			$layout = $this->getLayout();
			$shipping = Ccc::getModel('shipping')->load($shippingId);
			if (!$shipping) {
				throw new Exception("Invalid Id", 1);
				
			}
			$edit = $layout->createBlock('shipping_Edit')->setData(['shipping'=>$shipping])->toHtml();
			$this->getResponse()->jsonResponse(['html'=>$edit,'element'=>'content-html']);
			// die();
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
			$shipping->created_at = date("Y-m-d H-i-s"); 
		}

		$shipping->setData($shippingData['shipping']);
		
		if (!$shipping->save()) {
			throw new Exception("Unable to save", 1);
		}

		$layout = $this->getLayout();
		$grid = $layout->createBlock('Shipping_Grid')->toHtml();
		$this->getResponse()->jsonResponse(['html'=>$grid,'element'=>'content-html']);

	}catch (Exception $e) {
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
		$shipping = Ccc::getModel('Shipping')->load($id);

		if (!$shipping) {
			throw new Exception("Error Processing Request", 1);
		}

		$shipping->delete();

		$this->redirect('shipping','grid',null,true);

		$this->getMessage()->addMessage('Shipping deleted sucessfully.',Model_Core_Message :: SUCCESS);

		$layout = $this->getLayout();
		$grid = $layout->createBlock('Shipping_Grid')->toHtml();
		$this->getResponse()->jsonResponse(['html'=>$grid,'element'=>'content-html']);

	}catch(Exception $e){
		$this->getMessage()->addMessage('Shipping not deleted.',Model_Core_Message :: FAILURE);
	}
	}
}



