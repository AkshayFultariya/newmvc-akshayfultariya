<?php

class Block_Shipping_Edit extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		

		$this->setTemplate('shipping_method/edit.phtml');
	}

	public function getCollection()
	{
		if ($id = (int)Ccc::getModel('Core_Request')->getParam('shipping_id')) {
			$shipping = Ccc::getModel('Shipping')->load($id);
			return $shipping;
		}
		else{
		$shipping = Ccc::getModel('Shipping');
		// print_r($shipping);
		// die();
		return $shipping;

	}
	
}

}

?>
