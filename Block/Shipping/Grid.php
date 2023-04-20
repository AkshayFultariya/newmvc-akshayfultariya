<?php

class Block_Shipping_Grid extends Block_Core_Grid
{
	public function __construct()
	{
		parent::__construct();
		
		$this->getCollection();
		$this->_prepareColumns();
		$this->_prepareActions();
		$this->_prepareButtons();
		$this->setTitle('Manage Shipping Method');
	}
	public function getCollection()
	{
		$query = "SELECT * FROM `shipping` ORDER BY `shipping_id` DESC";
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