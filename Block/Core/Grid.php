<?php

class Block_Core_Grid extends Block_Core_Template
{
	protected $_title = null;
	protected $_columns = [];
	protected $_actions = [];
	protected $_buttons = [];
	protected $pager = null;

	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('core/grid.phtml')->getCollection();
		$this->_prepareColumns();
		$this->_prepareActions();
		$this->_prepareButtons();
		$this->setTitle('Manage Grid');
	}
	// public function getCollection()
	// {
	// 	$query = "SELECT * FROM `payment method` ORDER BY `payment_method_id` DESC";
	// 	$payments = Ccc::getModel('Payment')->fetchAll($query);
	// 	return $payments;
	// }

	public function setPager($pager)
	{
		$this->pager = $pager;
		return $this;
	}

	public function getPager(){
		if ($this->pager) {
			return $this->pager;
		}
		$pager = new Model_Core_Pager();
		$this->setPager($pager);
		return $pager;
	}

	public function getColumns()
	{
		return $this->_columns;
	}

	public function setColumns(array $columns)
	{
		$this->_columns = $columns;
		return $this;
	}

	public function addColumn($key,$value)
	{
		$this->_columns[$key] = $value;
		return $this;
	}
	public function removeColumns()
	{
		unset($this->_columns[$key]);
		return $this;
	}

	public function getColumn($key)
	{
		if (array_key_exists($key,$this->_columns)) {
			return $this->_columns[$key];
		}
		return null;
	}

	protected function _prepareColumns()
	{
		return $this;
	}

	public function getActions()
	{
		return $this->_actions;
	}

	public function setActions(array $actions)
	{
		$this->_actions = $actions;
		return $this;
	}

	public function addAction($key,$value)
	{
		$this->_actions[$key] = $value;
	}
	public function removeActions()
	{
		unset($this->_actions[$key]);
		return $this;
	}

	public function getAction($key)
	{
		if (array_key_exists($key,$this->_actions)) {
			return $this->_actions[$key];
		}
		return null;
	}

	protected function _prepareActions()
	{
		return $this;
	}

	public function getEditUrl($row,$key)
	{
		return $this->getUrl(null,$key,array('id' =>  $row->getId()),true);
	}

	public function getDeleteUrl($row,$key)
	{
		return $this->getUrl(null,$key,array('id' =>  $row->getId()),true);
	}

	public function getMediaUrl($row,$key)
	{
		return $this->getUrl('product_media',$key,array('id' =>  $row->getId()));
	}

	public function getPriceUrl($row,$key)
	{
		return $this->getUrl('salesman_price',$key,array('id' =>  $row->getId()));
	}

	public function getColumnValue($row,$key)
	{
		if ($key == 'status') {
			return $row->getStatusText($key);
		}
		return $row->$key;
	}

	public function getButtons()
	{
		return $this->_buttons;
	}

	public function setButtons(array $buttons)
	{
		$this->_buttons = $buttons;
		return $this;
	}

	public function addButton($key,$value)
	{
		$this->_buttons[$key] = $value;
		return $this;
	}
	public function removeButtons()
	{
		unset($this->_buttons[$key]);
		return $this;
	}

	public function getButton($key)
	{
		if (array_key_exists($key,$this->_buttons)) {
			return $this->_buttons[$key];
		}
		return null;
	}

	protected function _prepareButtons()
	{
		return $this;
	}

	public function setTitle($title)
	{
		$this->_title = $title;
		return $this;
	}

	public function getTitle()
	{
		return $this->_title;
	}
}

