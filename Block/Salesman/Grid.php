<?php

class Block_Salesman_Grid extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('salesman/grid.phtml');
	}
	public function getCollection()
	{
		$query = "SELECT * FROM `salesman` ORDER BY `salesman_id` DESC";
		$salesmen = Ccc::getModel('Salesman')->fetchAll($query);
		return $salesmen;
	}
}

?>