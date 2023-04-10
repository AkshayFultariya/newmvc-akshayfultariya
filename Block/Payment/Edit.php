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
		if ($id = (int)Ccc::getModel('Core_Request')->getParam('payment_method_id')) {
			$payment = Ccc::getModel('Payment')->load($id);
			return $payment;
		}
		else{
		$payment = Ccc::getModel('Payment');

		return $payment;
	}
	}
	
}

?>
