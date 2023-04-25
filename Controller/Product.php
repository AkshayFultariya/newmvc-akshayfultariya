<?php

class Controller_Product extends Controller_Core_Action
{

	public function indexAction()
	{
		$layout = $this->getLayout();
		$index = $layout->createBlock('Core_Template')->setTemplate('product/index.phtml');
		$layout->getChild('content')->addChild('index',$index);
		$layout->render();
    }

	public function gridAction()
	{
		try {
			$layout = $this->getLayout();
			$grid = $layout->createBlock('Product_Grid')->toHtml();
			echo json_encode(['html'=>$grid,'element'=>'content-html']);
			@header("Content-type:application/json");
			// die();
		} catch (Exception $e) {
	    	$this->getMessage()->addMessage('Currently Products not avilable',Model_Core_Message :: FAILURE);
			
		}
        	
	}


	public function addAction()
	{
		try {

			$layout = $this->getLayout();
			$product = Ccc::getModel('Product');
        	$add = $layout->createBlock('Product_Edit')->setData(['product'=>$product])->toHtml();
			echo json_encode(['html'=>$add,'element'=>'content-html']);
			@header("Content-type:application/json");
			// die();
		} catch (Exception $e) {
			$this->getMessage()->addMessage('Product not showed.',Model_Core_Message :: FAILURE);
		}
		
	}

	public function editAction()
	{
		try {
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
			$edit = $layout->createBlock('Product_Edit')->setData(['product'=>$product])->toHtml();

			echo json_encode(['html'=>$edit,'element'=>'content-html']);
			@header("content-type:application/json");
			die();
		} catch (Exception $e) {
			$this->getMessage()->addMessage('Product not showed.',Model_Core_Message :: FAILURE);
		}

	}

	public function saveAction()
	{

		try {
			
		
		if (!$this->getRequest()->isPost()) {
			throw new Exception("Invalid Id", 1);
		}
		$productData = $this->getRequest()->getPost();

		if (!$productData) {
			throw new Exception("Invalid data posted", 1);
		}

		if ($id = $this->getRequest()->getParam('id')) {
			$product = Ccc::getModel('Product');
			$product->load($id);
			$product->updated_at = date("Y-m-d H-i-s"); 
		}
		else{
			$product = Ccc::getModel('Product');
			// $product->entity_type_id = $product::ENTITY_TYPE_ID;
			$product->created_at = date("Y-m-d H-i-s"); 
		}
		$product->setData($productData['product']);
		
		if (!$product->save()) {
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
				$resource = $model->getResource()->setResourceName("product_{$backendType}")->setPrimaryKey('value_id');
				$query = "INSERT INTO `product_{$backendType}` (`product_id`,`attribute_id`,`value`) VALUES ('{$product->getId()}','{$attributeId}','{$v}') ON DUPLICATE KEY UPDATE `value` = '{$v}'";

				$id = $model->getResource()->getAdapter()->query($query);
				}
			}
		}	$layout = $this->getLayout();
			$grid = $layout->createBlock('Product_Grid')->toHtml();
			echo json_encode(['html'=>$grid,'element'=>'content-html']);
			@header("Content-type:application/json");
			// die();
			$this->getMessage()->addMessage('Vendor add/edit sucessfully',Model_Core_Message :: SUCCESS);
		} catch (Exception $e) {
		    $this->getMessage()->addMessage($e->getMessage(),Model_Core_Message :: FAILURE);
			
		}
		// $this->redirect('product','grid',null,true);
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
	    $layout = $this->getLayout();
		$grid = $layout->createBlock('Product_Grid')->toHtml();
		echo json_encode(['html'=>$grid,'element'=>'content-html']);
		@header("Content-type:application/json");
		// die();

	}catch(Exception $e){
		$this->getMessage()->addMessage('Product not deleted.',Model_Core_Message :: FAILURE);
	}
	}





}
