<?php

class Block_Order_Grid extends Block_Core_Grid
{
	public function __construct()
	{
		parent::__construct();
		$this->getCollection();
		$this->_prepareColumns();
		$this->_prepareActions();
		$this->_prepareButtons();
		$this->setTitle('Manage Order Method');
	}
	public function getCollection()
	{
		$query = "SELECT * FROM `orders` ORDER BY `order_id` DESC";
		$products = Ccc::getModel('Order')->fetchAll($query);
		return $products;
	}



protected function _prepareColumns()
	{
		$this->addColumn('order_id',['title' => 'quote Id']);
		$this->addColumn('customer_id',['title' => 'customer_id']);
		$this->addColumn('name',['title' => 'Name']);
		$this->addColumn('email',['title' => 'Email']);
		$this->addColumn('mobile',['title' => 'Mobile']);
		$this->addColumn('total',['title' => 'total']);
		$this->addColumn('created_at',['title' => 'Created_at']);
		$this->addColumn('status',['title' => 'status']);
		$this->addColumn('payment_method_id',['title' => 'payment_method_id']);
		$this->addColumn('shipping_method_id',['title' => 'shipping_method_id']);
		$this->addColumn('amount',['title' => 'amount']);

		return parent::_prepareColumns();
	}


	protected function _prepareActions()
	{
		$this->addAction('delete',['title' => 'Delete','method' => 'getDeleteUrl']);
		return parent::_prepareActions();
	}


	protected function _prepareButtons()
	{
		$this->addButton('order_id',['title' => 'Add New','url' => $this->getUrl('quote','grid')]);
		return parent::_prepareButtons();
	}
}