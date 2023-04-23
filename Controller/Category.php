<?php

class Controller_Category extends Controller_Core_Action
{
	public function gridAction()
	{
		try {
			Ccc::getModel('Core_Session')->start();

			$layout = $this->getLayout();
			$grid = $layout->createBlock('Category_Grid');
			$layout->getChild('content')->addChild('grid',$grid);
			echo $layout->toHtml();
			
		} catch (Exception $e) {
			$this->getMessage()->addMessage('Currently category not avilable',Model_Core_Message :: FAILURE);
		}
	}
   
	public function addAction()
	{
		try {
			$this->getMessage()->getSession()->start();

			$layout = $this->getLayout();
			$category = Ccc::getModel('Category');
        	$edit = $layout->createBlock('Category_Edit')->setData(['category'=>$category]);
			$layout->getChild('content')->addChild('edit',$edit);
			echo $layout->toHtml();
		} catch (Exception $e) {
			$this->getMessage()->addMessage('data not showed',Model_Core_Message :: FAILURE);
		}
	}

	public function editAction()
	{
		try {
			$this->getMessage()->getSession()->start();
			$categoryId = (int) Ccc::getModel('Core_Request')->getParam('category_id');
			if (!$categoryId) {
				throw new Exception("Invalid Id", 1);
				
			}
			$layout = $this->getLayout();
			$category = Ccc::getModel('Category')->load($categoryId);
			if (!$category) {
				throw new Exception("Invalid Id", 1);
				
			}
			$edit = $layout->createBlock('Category_Edit')->setData(['category'=>$category]);

			$layout->getChild('content')->addChild('edit',$edit);
			echo $layout->toHtml();

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

			$categoryPost = Ccc::getModel('Core_Request')->getPost();
			if (!$categoryPost) {
				throw new Exception("Data not found.", 1);
			}

			if ($id = (int) Ccc::getModel('Core_Request')->getParam('category_id')) {
				$category = Ccc::getModel('Category')->load($id);
				if (!$category) {
					throw new Exception("Data not found.", 1);
				}
				$category->updated_at = date('Y-m-d h-i-sA');
			} else {
				$category = Ccc::getModel('Category');
				$category->created_at = date('Y-m-d h-i-sA');
			}

			$category->setData($categoryPost['category']);

			if (!$category->save()) {
				throw new Exception("Category data not saved.", 1);
			} else {
				$category->updatePath();
				$this->getMessage()->addMessage('Category data saved Successfully.',Model_Core_Message :: SUCCESS);
			}

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
				$resource = $model->getResource()->setResourceName("category_{$backendType}")->setPrimaryKey('value_id');
				$query = "INSERT INTO `payment_{$backendType}` (`category_id`,`attribute_id`,`value`) VALUES ('{$category->getId()}','{$attributeId}','{$v}') ON DUPLICATE KEY UPDATE `value` = '{$v}'";

				$id = $model->getResource()->getAdapter()->query($query);
				}
			}
		}
		 catch (Exception $e) {
			 $this->getMessage()->addMessage('Invalid.',Model_Core_Message :: FAILURE);
		}

		$this->redirect('category','grid',null,true);

	}

	public function deleteAction()
	{
		try {
			Ccc::getModel('Core_Session')->start();
			$categoryId = Ccc::getModel('Core_Request')->getParam('category_id');
			if (!$categoryId) {
				throw new Exception("ID not found.", 1);
			}

			$category = Ccc::getModel('Category')->load($categoryId);
			$delete = $category->delete();
			if (!$delete) {
		  		throw new Exception("Category data not deleted.", 1);
			} else{
			  	$this->getMessage()->addMessage('Category data deleted Successfully.',Model_Core_Message :: SUCCESS);
			}
		} catch (Exception $e) {
			$this->getMessage()->addMessage('data not deleted',Model_Core_Message :: FAILURE);
		}

		$this->redirect('category','grid',null,true);

	}
}