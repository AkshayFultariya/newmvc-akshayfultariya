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
	{
		$itemData = $this->getRequest()->getPost('item');

		$item = Ccc::getModel('item');

		$item->setData($itemData);
		$item->save();

		$attributeData = $this->getRequest()->getPost('attribute');

		$queries = [];
		foreach ($attributeData as $backendType => $value) {
			foreach ($value as $attributeId => $v) {
				if (is_array($v)) {
					$v = implode(",", $v);
				}

				$model = Ccc::getModel('Core_Table');
				$resource = $model->getResource()->setResourceName("item_{$backendType}")->setPrimaryKey('value_id');
				$model->entity_id = $item->getId();
				$model->attribute_id = $attributeId;
				$model->value = $v;
				$model->save();
			}
		}
		$this->redirect('item','grid',null,true);
	}

} 

		


?>