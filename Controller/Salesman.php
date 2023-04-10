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
				$add = $layout->createBlock('Salesman_Edit');
				$layout->getChild('content')->addChild('content',$add);
				$layout->render();
			} catch (Exception $e) {
				
			}
	}

	public function editAction()
	{

		try {
				$this->getMessage()->getSession()->start();

				$layout = $this->getLayout();
				$edit = $layout->createBlock('Salesman_Edit');

				$layout->getChild('content')->addChild('content',$edit);
				$layout->render();
				
			} catch (Exception $e) {
				 $this->getMessage()->addMessage('data not showed',Model_Core_Message :: FAILURE);
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

				$postData = $this->getRequest()->getpost('salesman');
				if (!$postData) {
					throw new Exception("Invalid data posted.", 1);
				}
				$postDataAddress = $this->getRequest()->getpost('address');
				if (!$postDataAddress) {
					throw new Exception("Invalid data posted.", 1);
				}
				// print_r($postData);


				if ($id = (int)$this->getRequest()->getParam('salesman_id')) {
					$salesman = Ccc::getModel('Salesman')->load($id);
					$salesmanAddress = Ccc::getModel('Salesman_Address')->load($id);

					if (!$salesman) {
						throw new Exception("Invalid id.", 1);
					}
				$salesman->updated_at = date("Y-m-d H:i:s");
				}
				else{
					$salesman = Ccc::getModel('Salesman');
					$salesmanAddress = Ccc::getModel('Salesman_Address');
					$salesman->created_at = date("Y-m-d H:i:s");
				}
				$salesman->setData($postData);
				if (!$salesman->save()) {
					throw new Exception("Unable to save salesman.", 1);
				}
				$salesmanAddress->setData($postDataAddress);
				if (!$salesmanAddress->save()) {
					throw new Exception("Unable to save salesman.", 1);
				}

			    $this->getMessage()->addMessage('Salesman updeted sucessfully.',Model_Core_Message :: SUCCESS);


			} catch (Exception $e) {
			    $this->getMessage()->addMessage('Invalid.',Model_Core_Message :: FAILURE);
				
			}
			$this->redirect('salesman','grid',null,true);
		}

	public function deleteAction()
	{
	    try {
	    	$this->getMessage()->getSession()->start();
				if (!($id = (int) $this->getRequest()->getParam('salesman_id'))) {
				throw new Exception("Error Processing Request", 1);
				
			}
			$salesman = Ccc::getModel('Salesman')->load($id);

			if (!$salesman) {
				throw new Exception("Error Processing Request", 1);
			}

			$salesman->delete();

			$this->getMessage()->addMessage('Salesman updeted sucessfully.',Model_Core_Message :: SUCCESS);
			}catch(Exception $e){
				$this->getMessage()->addMessage('salesman not deleted.',Model_Core_Message :: FAILURE);
			}
			$this->redirect('salesman','grid',null,true);

	}

}
