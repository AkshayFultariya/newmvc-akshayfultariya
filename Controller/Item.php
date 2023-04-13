<?php

class Controller_Item extends Controller_Core_Action
{
	public function gridAction()
	{
		try {
			$this->getMessage()->getSession()->start();
			$layout = $this->getLayout();
			$grid = $layout->createBlock('Item_Grid');
			$layout->getChild('content')->addChild('grid',$grid);
			$layout->render();
			
		} catch (Exception $e) {
			
		}
	}

	public function addAction()
	{
		try {
			$this->getMessage()->getSession()->start();
			$layout = $this->getLayout();
			$item = Ccc::getModel('Item');
			$edit = $layout->createBlock('Item_Edit')->setData(['item'=>$item]);
			$layout->getChild('content')->addChild('edit',$edit);
			$layout->render();
		} catch (Exception $e) {
			
		}
		
	}

	public function editAction()
	{
		$this->getMessage()->getSession()->start();
			$itemId = (int) Ccc::getModel('Core_Request')->getParam('id');
			if (!$itemId) {
				throw new Exception("Invalid Id", 1);
				
			}
			$layout = $this->getLayout();
			$item = Ccc::getModel('Item')->load($itemId);
			if (!$item) {
				throw new Exception("Invalid Id", 1);
				
			}
			$edit = $layout->createBlock('Item_Edit')->setData(['item'=>$item]);

			$layout->getChild('content')->addChild('edit',$edit);
			$layout->render();

	}

	public function saveAction()	
}


?>