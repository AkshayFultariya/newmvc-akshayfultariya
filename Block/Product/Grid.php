<?php

class Block_Product_Grid extends Block_Core_Grid
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('product/grid.phtml');
		// $this->getCollection();
		// $this->_prepareColumns();
		// $this->_prepareActions();
		// $this->_prepareButtons();
		// $this->setTitle('Manage Payment Method');
	}
	public function getCollection()
	{
		$query = "SELECT * FROM `product` ORDER BY `product_id` DESC";
		$products = Ccc::getModel('Product')->fetchAll($query);
		return $products;
	}

	protected function _prepareColumns()
	{
		$this->addColumn('product_id',['title' => 'Product Id']);
		$this->addColumn('name',['title' => 'Name']);
		$this->addColumn('cost',['title' => 'Cost']);
		$this->addColumn('sku',['title' => 'SKU']);
		$this->addColumn('price',['title' => 'Price']);
		$this->addColumn('quantity',['title' => 'Quantity']);
		$this->addColumn('description',['title' => 'Description']);
		$this->addColumn('status',['title' => 'Status']);
		$this->addColumn('color',['title' => 'Color']);
		$this->addColumn('material',['title' => 'Material']);
		$this->addColumn('created_at',['title' => 'Created_at']);
		$this->addColumn('updated_at',['title' => 'Updated_at']);

		return parent::_prepareColumns();
	}


	protected function _prepareActions()
	{
		$this->addAction(null,['title' => 'Media','method' => 'getMediaUrl']);
		$this->addAction('edit',['title' => 'Edit','method' => 'getEditUrl']);
		$this->addAction('delete',['title' => 'Delete','method' => 'getDeleteUrl']);
		return parent::_prepareActions();
	}


	protected function _prepareButtons()
	{
		$this->addButton('product_id',['title' => 'Add New','url' => $this->getUrl('product','add')]);
		return parent::_prepareButtons();
	}
}

?>