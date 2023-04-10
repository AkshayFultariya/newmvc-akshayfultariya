<?php

class Block_Customer_Edit extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('customer/edit.phtml');
		// $this->getAddress();
		
	}
	

	public function getCollection()
	{
			if ($id = (int)Ccc::getModel('Core_Request')->getParam('customer_id')) {
			$customer = Ccc::getModel('Customer')->load($id);

			$query = "SELECT * FROM `customer_address` WHERE `customer_id` = {$id}";
			$address = Ccc::getModel('Customer_Address')->load($id);
			$cur = [$customer,$address];
			return $cur;
		}
		else{
		$customer = Ccc::getModel('Customer');
		$address = Ccc::getModel('Customer_Address');
		$cur = [$customer,$address];
		return $cur;

	}
	
}
}

?>
