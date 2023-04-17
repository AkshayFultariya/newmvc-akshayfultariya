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
		$shipping = $this->getData('shipping');
		return $shipping;

	}
	
}



?>
