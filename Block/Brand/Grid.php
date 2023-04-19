<?php

class Block_Brand_Grid extends Block_Core_Grid
{

	public function __construct()
	{
		parent::__construct();
		$this->getCollection();
		$this->_prepareColumns();
		$this->_prepareActions();
		$this->_prepareButtons();
		$this->setTitle('Manage Brand Method');
	}
	public function getCollection()
	{
		$query = "SELECT * FROM `brand` ORDER BY `brand_id` DESC";
		$payments = Ccc::getModel('Brand')->fetchAll($query);
		return $payments;
	}


	protected function _prepareColumns()
	{
		$this->addColumn('brand_id',['title' => 'Brand Id']);
		$this->addColumn('name',['title' => 'Name']);
		$this->addColumn('description',['title' => 'Description']);
		$this->addColumn('image',['title' => 'Image']);
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
		$this->addButton('brand_id',['title' => 'Add New','url' => $this->getUrl('brand','add')]);
		return parent::_prepareButtons();
	}

}

