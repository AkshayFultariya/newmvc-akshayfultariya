<?php

class Block_Salesman_Price__Edit extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('salesman/edit.phtml');
		// $this->getAddress();
		
	}
	

	public function getCollection()
	{
			if ($id = (int)Ccc::getModel('Core_Request')->getParam('salesman_id')) {
			$salesman = Ccc::getModel('Salesman')->load($id);

			$query = "SELECT * FROM `salesman_address` WHERE `salesman_id` = {$id}";
			$address = Ccc::getModel('Salesman_Address')->load($id);
			$s = [$salesman,$address];
			return $s;
		}
		else{
		$salesman = Ccc::getModel('salesman');
		$address = Ccc::getModel('Salesman_Address');
		$s = [$salesman,$address];
		return $s;
	}
	
}
}

?>
