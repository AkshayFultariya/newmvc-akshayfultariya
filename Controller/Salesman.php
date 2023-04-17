<?php


class Controller_Salesman extends Controller_Core_Action
{
	public function gridAction()
	{
		try {
			$this->getMessage()->getSession()->start();

			$layout = $this->getLayout();
			$grid = $layout->createBlock('Salesman_Grid');
			$layout->getChild('content')->addChild('grid',$grid);
			$layout->render();

			
		} catch (Exception $e) {
			$this->getMessage()->addMessage('Currently salesmen not avilable',Model_Core_Message :: FAILURE);
			
		}
	}

	public function addAction()
	{
		try {
	        	$this->getMessage()->getSession()->start();

	        	$layout = $this->getLayout();
				$salesman = Ccc::getModel('Salesman');
				$address = Ccc::getModel('Salesman_Address');
	        	$edit = $layout->createBlock('Salesman_Edit')->setData(['salesman'=>$salesman,'address'=>$address]);
				$layout->getChild('content')->addChild('edit',$edit);
				$layout->render();
				// $layout->render();
			} catch (Exception $e) {
				
			}
	}

	public function editAction()
	{

		try {
				$this->getMessage()->getSession()->start();
			$salesmanId = (int) Ccc::getModel('Core_Request')->getParam('id');
			if (!$salesmanId) {
				throw new Exception("Invalid Id", 1);
				
			}
			$layout = $this->getLayout();
			$salesman = Ccc::getModel('Salesman')->load($salesmanId);
			if (!$salesman) {
				throw new Exception("Invalid Id", 1);
			}
			$address = Ccc::getModel('Salesman_Address')->load($salesmanId);
			if (!$address) {
				throw new Exception("Invalid Id", 1);
			}
			$edit = $layout->createBlock('Salesman_Edit')->setData(['salesman'=>$salesman,'address' => $address]);

			$layout->getChild('content')->addChild('edit',$edit);
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
			
			$salesmanPost = Ccc::getModel('Core_Request')->getPost('salesman');
			// print_r($salesmanPost);
			// die();
			if (!$salesmanPost) {
				throw new Exception("Data not found.", 1);
			}

			if ($id = (int) Ccc::getModel('Core_Request')->getParam('id')) {
				$salesman = Ccc::getModel('salesman')->load($id);
				if (!$salesman) {
					throw new Exception("Data not found.", 1);
				}
				$salesman->updated_at = date('Y-m-d h-i-sA');
			} else {
				$salesman = Ccc::getModel('salesman');
				$salesman->created_at = date('Y-m-d h-i-sA');
			}

			$salesman->setData($salesmanPost);
			if (!$salesman->save()) {
				throw new Exception("salesman data not saved.", 1);
			}
			else{
				$addressPost = Ccc::getModel('Core_Request')->getPost('address');
				if (!$addressPost) {
					throw new Exception("Data not found.", 1);
				}

				if ($id = (int) Ccc::getModel('Core_Request')->getParam('id')) {
					$address = Ccc::getModel('salesman_Address')->load($id);
					if (!$address) {
						throw new Exception("Data not found.", 1);
					}
					$address->address_id = $salesman->salesman_id;
				} else {
					$address = Ccc::getModel('salesman_Address');
					$address->salesman_id = $salesman->salesman_id;
				}

				$address->setData($addressPost);
				if (!$address->save()) {
					throw new Exception("salesman data not saved.", 1);
				}
			}
			$this->getMessage()->addMessage('salesman data saved Successfully.');
		} catch (Exception $e) {
			$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
		}
		
		$this->redirect('salesman', 'grid', [], true);
	}

	public function deleteAction()
	{
	    try {
	    	$this->getMessage()->getSession()->start();
				if (!($id = (int) $this->getRequest()->getParam('id'))) {
				throw new Exception("Error Processing Request", 1);
				
			}
			$salesman = Ccc::getModel('Salesman')->load($id);
			if (!$salesman->delete()) {
				throw new Exception("Error Processing Request", 1);
			}
			$address = Ccc::getModel('Salesman_Address')->load($id);
			if (!$address->delete()) {
				throw new Exception("Error Processing Request", 1);
			}



			$this->getMessage()->addMessage('Salesman deleted sucessfully.',Model_Core_Message :: SUCCESS);
			}catch(Exception $e){
				$this->getMessage()->addMessage('salesman not deleted.',Model_Core_Message :: FAILURE);
			}
			$this->redirect('salesman','grid',null,true);

	}

}
