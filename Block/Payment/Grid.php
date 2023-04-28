<?php

class Block_Payment_Grid extends Block_Core_Grid
{

	public function __construct()
	{
		parent::__construct();
		$this->getCollection();
		$this->_prepareColumns();
		$this->_prepareActions();
		$this->_prepareButtons();
		$this->setTitle('Manage Payment Method');
		// $this->setTemplate('payment_method/grid.phtml');

	}
	public function getCollection()
	{
		$query = "SELECT count(`payment_method_id`) FROM `payment`";
		$totalRecord = Ccc::getModel('Core_Adapter')->fetchOne($query);

		$this->getPager()->setTotalRecords($totalRecord)->calculate();
		// $pager = Ccc::getModel('Core_Pager');

		$query = "SELECT * FROM `payment` LIMIT {$this->getPager()->startLimit},{$this->getPager()->recordPerPage}";
		$payments = Ccc::getModel('Payment')->fetchAll($query);
		// echo "<pre>";
		// print_r($payments);
		// die();
		return $payments;
	}


	protected function _prepareColumns()
	{
		$this->addColumn('payment_method_id',['title' => 'Payment Id']);
		$this->addColumn('name',['title' => 'Name']);
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
		$this->addButton('payment_method_id',['title' => 'Add New','url' => $this->getUrl('payment','add')]);
		return parent::_prepareButtons();
	}

}

