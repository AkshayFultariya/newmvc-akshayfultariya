<?php

class Block_Quote_Customer extends Block_Core_Template
{

	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('quote/grid.phtml');
	}
	public function getCollection()
	{
		// $query = "SELECT * FROM `quote` ORDER BY `order_id` DESC";
		// $quotes = Ccc::getModel('Quote')->fetchAll($query);

		$sql = "SELECT * FROM `customer` ORDER BY `customer_id` DESC";
		$customer = Ccc::getModel('Customer')->fetchAll($sql);

		// $a = [$customer];
		return $customer;
	}


}

