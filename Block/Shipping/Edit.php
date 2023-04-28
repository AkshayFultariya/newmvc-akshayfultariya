<?php

class Block_Shipping_Edit extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('shipping_method/edit.phtml');
	}

	public function getRow()
	{
		return  $this->shipping;
		
	}

	public function getAttributes()
	{
		$attributes = Ccc::getModel('Shipping')->getAttributes();
		return $attributes;
	}

	// public function calculate()
	// {
	// 	$
	// }
	
}



?>
