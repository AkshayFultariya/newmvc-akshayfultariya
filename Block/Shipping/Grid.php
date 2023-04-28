<?php

class Block_Shipping_Grid extends Block_Core_Grid
{
	public function __construct()
	{
		parent::__construct();
		
		// $this->getCollection();
		// $this->_prepareColumns();
		// $this->_prepareActions();
		// $this->_prepareButtons();
		$this->setTitle('Manage Shipping Method');
		$this->setTemplate('shipping_method/grid.phtml');
	}
	public function getCollection()
	{
		$query = "SELECT count(`shipping_id`) FROM `shipping`";
		$totalRecord = Ccc::getModel('Core_Adapter')->fetchOne($query);
		// print_r($totalRecord);
		$this->getPager()->setTotalRecords($totalRecord)->calculate();
		// $pager = Ccc::getModel('Core_Pager');

		$query = "SELECT * FROM `shipping` LIMIT {$this->getPager()->startLimit},{$this->getPager()->recordPerPage}";
		$shippings = Ccc::getModel('Shipping')->fetchAll($query);
		return $shippings;
	}




	protected function _prepareColumns()
	{
		$this->addColumn('shipping_id',['title' => 'Shipping Id']);
		$this->addColumn('name',['title' => 'Name']);
		$this->addColumn('amount',['title' => 'Amount']);
		$this->addColumn('status',['title' => 'Status']);
		$this->addColumn('created_at',['title' => 'Created_at']);
		$this->addColumn('updated_at',['title' => 'Updated_at']);

		return parent::_prepareColumns();
	}


	protected function _prepareActions()
	{
		$this->addAction('edit',['title' => 'Edit','method' => 'getEditUrl']);
		$this->addAction('delete',['title' => 'Delete','method' => 'getDeleteUrl']);
		return parent::_prepareActions();
	}


	protected function _prepareButtons()
	{
		$this->addButton('shipping_id',['title' => 'Add New','url' => $this->getUrl('shipping','add')]);
		return parent::_prepareButtons();
	}
}

?>