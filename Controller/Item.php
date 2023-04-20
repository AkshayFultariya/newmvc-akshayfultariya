<?php

class Controller_Item extends Controller_Core_Action
{
	public function gridAction()
	{
		try {
			$layout = $this->getLayout();
			$grid = $layout->createBlock('Item_Grid');
			$layout->getChild('content')->addChild('grid',$grid);
			echo $layout->toHtml();
			
		} catch (Exception $e) {
			
		}
	}

	public function addAction()
	{
		try {
			$layout = $this->getLayout();
			$item = Ccc::getModel('Item');
			$edit = $layout->createBlock('Item_Edit')->setData(['item'=>$item]);
			$layout->getChild('content')->addChild('edit',$edit);
			echo $layout->toHtml();
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
			echo $layout->toHtml();

	}

	public function saveAction()
	{
		try {
			
		
		if (!$this->getRequest()->isPost()) {
			throw new Exception("Invalid Id", 1);
		}
		$itemData = $this->getRequest()->getPost();

		if (!$itemData) {
			throw new Exception("Invalid data posted", 1);
		}

		if ($id = $this->getRequest()->getParam('id')) {
			$item = Ccc::getModel('item');
			$item->load($id);
			$item->updated_at = date("Y-m-d H-i-s"); 
		}
		else{
			$item = Ccc::getModel('item');
			$item->entity_type_id = $item::ENTITY_TYPE_ID;
			$item->created_at = date("Y-m-d H-i-s"); 
		}

		$item->setData($itemData['item']);
		
		if (!$item->save()) {
			throw new Exception("Unable to save", 1);
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
				$resource = $model->getResource()->setResourceName("item_{$backendType}")->setPrimaryKey('value_id');
				$query = "INSERT INTO `item_{$backendType}` (`entity_id`,`attribute_id`,`value`) VALUES ('{$item->getId()}','{$attributeId}','{$v}') ON DUPLICATE KEY UPDATE `value` = '{$v}'";

				$id = $model->getResource()->getAdapter()->query($query);
				// if ($id) {
				// 	$sql = "SELECT * FROM `item_{$backend_type}` WHERE `entity_id` = `{$id}` AND `attribute_id` = `{$attributeId}`";
				// 	$model->fetchRow($sql);
				// }
				// else{
				// 	$model->entity_id = $item->getId();
				//     $model->attribute_id = $attributeId;
				// }
				
				// $model->value = $v;
				// if (!$item->save()) {
				// 	throw new Exception("Unable to save", 1);
				}
			}
		}
		} catch (Exception $e) {
			
		}
		$this->redirect('item','grid',null,true);
	}

} 

		

?>