<?php

class Controller_Shipping extends Controller_Core_Action
{

	public function gridAction()
	{
		try {
			$this->getMessage()->getSession()->start();
			$layout = $this->getLayout();
			$grid = $layout->createBlock('Shipping_Grid');
			$layout->getChild('content')->addChild('grid',$grid);
			$layout->render();
		} catch (Exception $e) {
	    	$this->getMessage()->addMessage('Currently Shippings not avilable',Model_Core_Message :: FAILURE);
			
		}
        	
	}


	public function addAction()
	{
		try {
        	$this->getMessage()->getSession()->start();

			$layout = $this->getLayout();
			$shipping = Ccc::getModel('Shipping');
        	$edit = $layout->createBlock('Shipping_Edit')->setData(['shipping'=>$shipping]);
			$layout->getChild('content')->addChild('edit',$edit);
			$layout->render();
		} catch (Exception $e) {
			$this->getMessage()->addMessage('Shipping not showed.',Model_Core_Message :: FAILURE);
		}
		
	}

	public function editAction()
	{
		try {
	        $this->getMessage()->getSession()->start();
			$shippingId = (int) Ccc::getModel('Core_Request')->getParam('id');
			if (!$shippingId) {
				throw new Exception("Invalid Id", 1);
				
			}
			$layout = $this->getLayout();
			$shipping = Ccc::getModel('shipping')->load($shippingId);
			if (!$shipping) {
				throw new Exception("Invalid Id", 1);
				
			}
			$edit = $layout->createBlock('shipping_Edit')->setData(['shipping'=>$shipping]);

			$layout->getChild('content')->addChild('edit',$edit);
			$layout->render();
		} catch (Exception $e) {
			$this->getMessage()->addMessage('Shipping not showed.',Model_Core_Message :: FAILURE);
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

			$postData = $this->getRequest()->getpost('shipping');



			if (!$postData) {

				throw new Exception("Invalid data posted.", 1);
			}
			if ($id = (int)$this->getRequest()->getParam('id')) {
				$shipping = Ccc::getModel('Shipping')->load($id);

				if (!$shipping) {
					throw new Exception("Invalid id.", 1);
				}
			$shipping->updated_at = date("Y-m-d H:i:s");
			}
			else{
				$shipping = Ccc::getModel('Shipping');
				$shipping->created_at = date("Y-m-d H:i:s");
			}
			$shipping->setData($postData);
			if (!$shipping->save()) {
				throw new Exception("Unable to save shipping.", 1);
			}
			// die();
		    $this->getMessage()->addMessage('Shipping updeted sucessfully.',Model_Core_Message :: SUCCESS);


		} catch (Exception $e) {
		    $this->getMessage()->addMessage('Invalid.',Model_Core_Message :: FAILURE);
			
		}
		$this->redirect('shipping','grid',null,true);
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

	}catch(Exception $e){
		$this->getMessage()->addMessage('Shipping not deleted.',Model_Core_Message :: FAILURE);
	}
	}
}



