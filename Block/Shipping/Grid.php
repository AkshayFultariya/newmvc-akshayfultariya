<?php

class Block_Shipping_Grid extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		
		$this->setTemplate('shipping_method/grid.phtml');
	}
	public function getCollection()
	{
		$query = "SELECT * FROM `shipping method` ORDER BY `shipping_id` DESC";
		$shippings = Ccc::getModel('Shipping')->fetchAll($query);
		return $shippings;
	}
}

?>