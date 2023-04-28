<?php

class Controller_Item extends Controller_Core_Action
{
	public function indexAction()
	{
		$layout = $this->getLayout();
		$index = $layout->createBlock('Core_Template')->setTemplate('item/index.phtml');
		$layout->getChild('content')->addChild('index',$index);
		$this->renderLayout();
    }

	public function gridAction()
	{
		try {
			$grid = $this->getLayout()->createBlock('Item_Grid');
			if ($this->getRequest()->isPost()) {
				if ($recordPerPage = (int) $this->getRequest()->getPost('selectRecordPerPage')) {
					$grid->getPager()->setRecordPerPage($recordPerPage);
				}
			}
			$grid = $grid->toHtml();
			$this->getResponse()->jsonResponse(['html'=>$grid,'element'=>'content-html']);
			
		} catch (Exception $e) {
			
		}
	}

	public function addAction()
	{
		try {
			$layout = $this->getLayout();
			$item = Ccc::getModel('Item');
			$add = $layout->createBlock('Item_Edit')->setData(['item'=>$item])->toHtml();
			$this->getResponse()->jsonResponse(['html'=>$add,'element'=>'content-html']);
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
			$edit = $layout->createBlock('Item_Edit')->setData(['item'=>$item])->toHtml();

			$this->getResponse()->jsonResponse(['html'=>$edit,'element'=>'content-html']);

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
				}
			}
		}
			$layout = $this->getLayout();
			$grid = $layout->createBlock('Item_Grid')->toHtml();
			$this->getResponse()->jsonResponse(['html'=>$grid,'element'=>'content-html']);
		} catch (Exception $e) {
			
		}
	}

} 

		

?>