<?php

class Controller_Admin extends Controller_Core_Action
{
	public function indexAction()
	{
		$layout = $this->getLayout();
		$index = $layout->createBlock('Core_Template')->setTemplate('admin/index.phtml');
		$layout->getChild('content')->addChild('index',$index);
		$this->renderLayout();
	}

	public function gridAction()
	{
		try{
			$grid = $this->getLayout()->createBlock('Admin_Grid');
			if ($this->getRequest()->isPost()) {
				if ($recordPerPage = (int) $this->getRequest()->getPost('selectRecordPerPage')) {
					$grid->getPager()->setRecordPerPage($recordPerPage);
				}
			}
			$grid = $grid->toHtml();
			$this->getResponse()->jsonResponse(['html'=>$grid,'element'=>'content-html']);			
		} catch (Exception $e) {
			
		}
		
		
	}

	public function addAction()
	{
		try{
			$layout = $this->getLayout();
			$admin = Ccc::getModel('admin');
        	$add = $layout->createBlock('Admin_Edit')->setData(['admin'=>$admin])->toHtml();
			$this->getResponse()->jsonResponse(['html'=>$add,'element'=>'content-html']);
		
	}
		catch (Exception $e) {
			
		}
	}

	public function editAction()
	{
		try{
			$adminId = (int) Ccc::getModel('Core_Request')->getParam('id');
			if (!$adminId) {
				throw new Exception("Invalid Id", 1);
				
			}
			$layout = $this->getLayout();
			$admin = Ccc::getModel('Admin')->load($adminId);
			if (!$admin) {
				throw new Exception("Invalid Id", 1);
				
			}
			$edit = $layout->createBlock('Admin_Edit')->setData(['admin'=>$admin])->toHtml();

			$this->getResponse()->jsonResponse(['html'=>$edit,'element'=>'content-html']);		
	}
		catch (Exception $e) {
			$this->getMessage()->addMessage('Admin not showed.',Model_Core_Message :: FAILURE);
		}
		
			
		
	}

	public function saveAction()
	{
		try {
			if (!$this->getRequest()->isPost()) {
				throw new Exception("Error Processing Request", 1);
			}

		$postData = $this->getRequest()->getPost();
		if (!$postData) {
			throw new Exception("Error Processing Request", 1);
		}


		if ($id = (int) $this->getRequest()->getParam('id')) {
		$admin = Ccc::getModel('Admin')->load($id);
			
		if (!$admin) {
			throw new Exception("Error Processing Request", 1);
			// echo "111";
		}
		$admin->updated_at = date("Y-m-d H:i:s");
		}
		else
		{
			$admin = Ccc::getModel('Admin');
			$admin->created_at = date("Y-m-d H:i:s");
		}
		$admin->setData($postData['admin']);

		if (!$admin->save()) {
			throw new Exception("unable to save admin",1);
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
				$resource = $model->getResource()->setResourceName("admin_{$backendType}")->setPrimaryKey('value_id');
				$query = "INSERT INTO `admin_{$backendType}` (`admin_id`,`attribute_id`,`value`) VALUES ('{$admin->getId()}','{$attributeId}','{$v}') ON DUPLICATE KEY UPDATE `value` = '{$v}'";

				$id = $model->getResource()->getAdapter()->query($query);
				}
			}
		}
		$layout = $this->getLayout();
		$grid = $layout->createBlock('Admin_Grid')->toHtml();
		$this->getResponse()->jsonResponse(['html'=>$grid,'element'=>'content-html']);
		} catch (Exception $e) {
			
		}
	}

	public function deleteAction()
	{
		try {
			if (!($id = (int) $this->getRequest()->getParam('id'))) {
			throw new Exception("Error Processing Request", 1);
			
		}
		$admin = Ccc::getModel('Admin')->load($id);

		if (!$admin) {
			throw new Exception("Error Processing Request", 1);
		}

		$admin->delete();

		$this->redirect('admin','grid',null,true);

		$layout = $this->getLayout();
		$grid = $layout->createBlock('Admin_Grid')->toHtml();
		$this->getResponse()->jsonResponse(['html'=>$grid,'element'=>'content-html']);

	}catch(Exception $e){

	}
	}


}






