<?php

class Controller_Brand extends Controller_Core_Action
{
	public function gridAction()
	{
		try {

			// $this->getMessage()->getSession()->start();
			$layout = $this->getLayout()->setTemplate('core/layout/1column.phtml');
			$grid = $layout->createBlock('Brand_Grid');
			$layout->getChild('content')->addChild('grid',$grid);
			echo $layout->toHtml();

		} catch (Exception $e) {
		    $this->getMessage()->addMessage('Brands not avilable',Model_Core_Message :: FAILURE);
			
		}
		
	}

	public function addAction()
	{
		try {
        	$this->getMessage()->getSession()->start();

			$layout = $this->getLayout();
			$brand = Ccc::getModel('Brand');
        	$edit = $layout->createBlock('Brand_Edit')->setData(['brand'=>$brand]);
			$layout->getChild('content')->addChild('edit',$edit);
			echo $layout->toHtml();
		} catch (Exception $e) {
			$this->getMessage()->addMessage('Brand not showed.',Model_Core_Message :: FAILURE);
		}
		
	}

	public function editAction()
	{
		try {
	        $this->getMessage()->getSession()->start();
			$brandId = (int) Ccc::getModel('Core_Request')->getParam('id');
			if (!$brandId) {
				throw new Exception("Invalid Id", 1);
				
			}
			$layout = $this->getLayout();
			$brand = Ccc::getModel('Brand')->load($brandId);
			if (!$brand) {
				throw new Exception("Invalid Id", 1);
				
			}
			$edit = $layout->createBlock('Brand_Edit')->setData(['brand'=>$brand]);

			$layout->getChild('content')->addChild('edit',$edit);
			echo $layout->toHtml();
		} catch (Exception $e) {
			$this->getMessage()->addMessage('Brand not showed.',Model_Core_Message :: FAILURE);
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

			$postData = $this->getRequest()->getpost('brand');

			if (!$postData) {
				throw new Exception("Invalid data posted.", 1);
			}

			if ($id = (int)$this->getRequest()->getParam('id')) {
				$brand = Ccc::getModel('Brand')->load($id);

				if (!$brand) {
					throw new Exception("Invalid id.", 1);
				}
			$brand->updated_at = date("Y-m-d H:i:s");
			}
			else{
				$brand = Ccc::getModel('Brand');
				$brand->created_at = date("Y-m-d H:i:s");
			}
			$brand->setData($postData);

			if (!$brand->save()) {
				throw new Exception("Unable to save payment.", 1);
			}
		    $this->getMessage()->addMessage('Brand updeted sucessfully.',Model_Core_Message :: SUCCESS);


		} catch (Exception $e) {
		    $this->getMessage()->addMessage('Invalid.',Model_Core_Message :: FAILURE);
			
		}
		$this->redirect('brand','grid',null,true);
	}

	public function deleteAction()
	{
		try {
			$this->getMessage()->getSession()->start();
			if (!($id = (int) $this->getRequest()->getParam('id'))) {
			throw new Exception("Error Processing Request", 1);
			
			}
			$payment = Ccc::getModel('Brand')->load($id);

			if (!$payment) {
				throw new Exception("Error Processing Request", 1);
			}

			$payment->delete();
			$this->getMessage()->addMessage('Brand deleted sucessfully.',Model_Core_Message :: SUCCESS);

		}catch(Exception $e){
			$this->getMessage()->addMessage('Brand not deleted.',Model_Core_Message :: FAILURE);
		}
			$this->redirect('brand','grid',null,true);
	}





}
