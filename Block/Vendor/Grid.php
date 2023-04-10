<?php

class Block_Vendor_Grid extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('vendor/grid.phtml');
	}
	public function getCollection()
	{
		$query = "SELECT * FROM `vendor` ORDER BY `vendor_id` DESC";
		$vendors = Ccc::getModel('Vendor')->fetchAll($query);
		return $vendors;
	}
}

?>