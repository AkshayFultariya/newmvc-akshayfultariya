<?php

class Block_Payment_Edit extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('payment_method/edit.phtml');
	}

	public function getRow()
	{
		return  $this->payment;
		
	}

	public function getAttributes()
	{
		$attributes = Ccc::getModel('Payment')->getAttributes();
		return $attributes;
	}
}
	



