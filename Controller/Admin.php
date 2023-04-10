<?php

class Controller_Admin extends Controller_Core_Action
{
	public function gridAction()
	{
		// echo '<pre>';
		try {
			$this->getMessage()->getSession()->start();
			$layout = $this->getLayout();
			$grid = $layout->createBlock('Admin_Grid');
			$layout->getChild('content')->addChild('content',$grid);
			$layout->render();
			
		} catch (Exception $e) {
			
		}
		
		
	}

	public function addAction()
	{
		try{
			$this->getMessage()->getSession()->start();
		    $layout = $this->getLayout();
			$add = $layout->createBlock('Admin_Edit');
			$layout->getChild('content')->addChild('content',$add);
			$layout->render();
		
	}
		catch (Exception $e) {
			
		}
	}

	public function editAction()
	{
		try{
			$this->getMessage()->getSession()->start();
			$layout = $this->getLayout();
			$edit = $layout->createBlock('Admin_Edit');
			$layout->getChild('content')->addChild('content',$edit);
			$layout->render();
		
	}
		catch (Exception $e) {
			
		}
		
			
		
	}

	public function saveAction()
	{
		try {
			if (!$this->getRequest()->isPost()) {
				throw new Exception("Error Processing Request", 1);
			}

		$postData = $this->getRequest()->getPost('admin');
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
		$admin->setData($postData);

		if (!$admin->save()) {
			throw new Exception("unable to save admin",1);
		}
	
		} catch (Exception $e) {
			
		}
		$this->redirect('admin','grid',null,true);
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

	}catch(Exception $e){

	}
	}


}






