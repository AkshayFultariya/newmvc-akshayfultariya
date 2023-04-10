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
			$layout->render();
			
		} catch (Exception $e) {
			$this->getMessage()->addMessage('Currently category not avilable',Model_Core_Message :: FAILURE);
		}
	}
   
	public function addAction()
	{
		try {
			Ccc::getModel('Core_Session')->start();
        	$layout = $this->getLayout();
			$add = $layout->createBlock('Category_Edit');
			$layout->getChild('content')->addChild('content',$add);
			$layout->render();
		} catch (Exception $e) {
			$this->getMessage()->addMessage('data not showed',Model_Core_Message :: FAILURE);
		}
	}

	public function editAction()
	{
		try {
			Ccc::getModel('Core_Session')->start();
			$layout = $this->getLayout();
			$edit = $layout->createBlock('Category_Edit');

			$layout->getChild('content')->addChild('content',$edit);
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

			$categoryPost = Ccc::getModel('Core_Request')->getPost('category');
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

			$category->setData($categoryPost);

			if (!$category->save()) {
				throw new Exception("Category data not saved.", 1);
			} else {
				$category->updatePath();
				$this->getMessage()->addMessage('Category data saved Successfully.',Model_Core_Message :: SUCCESS);
			}

		} catch (Exception $e) {
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