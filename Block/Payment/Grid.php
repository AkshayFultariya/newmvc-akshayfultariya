<?php

class Block_Payment_Grid extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('payment_method/grid.phtml')->getCollection();
	}
	public function getCollection()
	{
		$query = "SELECT * FROM `payment method` ORDER BY `payment_method_id` DESC";
		$payments = Ccc::getModel('Payment')->fetchAll($query);
		return $payments;
	}
}

?>