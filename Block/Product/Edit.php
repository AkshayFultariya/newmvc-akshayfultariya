<?php

class Block_Product_Edit extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('product/edit.phtml');
	}

	public function getRow()
	{
		return  $this->product;
		
	}

	public function getAttributes()
	{
		$attributes = Ccc::getModel('Product')->getAttributes();
		return $attributes;
	}

}

?>
