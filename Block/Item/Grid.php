<?php

class Block_Item_Grid extends Block_Core_Grid
{

	public function __construct()
	{
		parent::__construct();
		$this->getCollection();
		$this->_prepareColumns();
		$this->_prepareActions();
		$this->_prepareButtons();
		// $this->setTemplate('item/grid.phtml');
	}
	public function getCollection()
	{
		$query = "SELECT count(`entity_id`) FROM `item`";
		$totalRecord = Ccc::getModel('Core_Adapter')->fetchOne($query);

		$this->getPager()->setTotalRecords($totalRecord)->calculate();
		// $pager = Ccc::getModel('Core_Pager');

		$query = "SELECT * FROM `item` LIMIT {$this->getPager()->startLimit},{$this->getPager()->recordPerPage}";
		$items = Ccc::getModel('Item')->fetchAll($query);
		return $items;
	}

	protected function _prepareColumns()
	{
		$this->addColumn('entity_id',['title' => 'Entity Id']);
		$this->addColumn('sku',['title' => 'SKU']);
		$this->addColumn('entity__type_id',['title' => 'Entity type Id']);
		$this->addColumn('status',['title' => 'Status']);
		$this->addColumn('created_at',['title' => 'Created_at']);
		$this->addColumn('updated_at',['title' => 'Updated_at']);

		return parent::_prepareColumns();
	}


	protected function _prepareActions()
	{
		$this->addAction('edit',['title' => 'Edit','method' => 'getEditUrl']);
		return parent::_prepareActions();
	}


	protected function _prepareButtons()
	{
		$this->addButton('entity_id',['title' => 'Add New','url' => $this->getUrl('item','add')]);
		return parent::_prepareButtons();
	}
}

?>