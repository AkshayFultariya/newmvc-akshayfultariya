<?php

class Block_Admin_Grid extends Block_Core_Grid
{
	public function __construct()
	{
		parent::__construct();
		// $this->getCollection();
		// $this->_prepareColumns();
		// $this->_prepareActions();
		// $this->_prepareButtons();
		$this->setTitle('Manage Admin Method');
		$this->setTemplate('payment_method/grid.phtml');
		
	}
	public function getCollection()
	{
		$query = "SELECT * FROM `admin` ORDER BY `admin_id` DESC";
		$admins = Ccc::getModel('Admin')->fetchAll($query);
		return $admins;
	}

	protected function _prepareColumns()
	{
		$this->addColumn('admin_id',['title' => 'Admin Id']);
		$this->addColumn('email',['title' => 'Email']);
		$this->addColumn('password',['title' => 'Password']);
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
		$this->addButton('admin_id',['title' => 'Add New','url' => $this->getUrl('admin','add')]);
		return parent::_prepareButtons();
	}
}

?>