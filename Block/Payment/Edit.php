<?php

class Block_Payment_Edit extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('payment_method/edit.phtml')->getCollection();
	}

	public function getCollection()
	{
		$payment = $this->getData('payment');
		return $payment;
	}
	}
	


?>
