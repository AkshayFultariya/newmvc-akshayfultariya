<?php

class Block_Category_Grid extends Block_Core_Grid
{
	public function __construct()
	{
		parent::__construct();
		// $this->setTemplate('category/grid.phtml');
		$this->getCollection();
		$this->_prepareColumns();
		$this->_prepareActions();
		$this->_prepareButtons();
		$this->setTitle('Manage Customer Method');
	}
	public function getCollection()
	{
		$category = Ccc::getModel('Category');
		$query = "SELECT * FROM `{$category->getResource()->getResourceName()}` WHERE `parent_id` > 0 ORDER BY `path` ASC;";
		$categories = $category->fetchAll($query);
		return $categories;
	}

	protected function _prepareColumns()
	{
		$this->addColumn('category_id',['title' => 'Category Id']);
		$this->addColumn('name',['title' => 'Name']);
		$this->addColumn('description',['title' => 'Description']);
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
		$this->addButton('category_id',['title' => 'Add New','url' => $this->getUrl('category','add')]);
		return parent::_prepareButtons();
	}
}

?>