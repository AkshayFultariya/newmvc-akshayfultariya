<?php

class Block_Vendor_Edit extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('vendor/edit.phtml');
		// $this->getAddress();
		
	}
	

	public function getCollection()
	{
			if ($id = (int)Ccc::getModel('Core_Request')->getParam('vendor_id')) {
			$vendor = Ccc::getModel('Vendor')->load($id);

			$query = "SELECT * FROM `vendor_address` WHERE `vendor_id` = {$id}";
			$address = Ccc::getModel('Vendor_Address')->load($id);
			$v = [$vendor,$address];
			return $v;
		}
		else{
		$vendor = Ccc::getModel('Vendor');
		$address = Ccc::getModel('Vendor_Address');
		$v = [$vendor,$address];
		return $v;

		// $this->setTemplate('product/edit.phtml')->setData(['product' => $product]);
	}
	
}
}

?>
