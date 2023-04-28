<?php

class Block_Customer_Edit extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('customer/edit.phtml');
	}
	
	public function getRow()
	{
		$customer = $this->getData('customer');
		$billingAddress = $this->getData('billingAddress');
		$shippingAddress = $this->getData('shippingAddress');
		$final = [$customer,$billingAddress,$shippingAddress];
		return $final;
	}

	public function getAttributes()
	{
		$attributes = Ccc::getModel('Customer')->getAttributes();
		return $attributes;
	}

	// public function getBillingAddress()
	// {
	// 	$billingAddress = $this->getData('billingAddress');
	// 	// print_r($billingAddress);
	// 	// die();
	// 	return $billingAddress;
	// }

	// public function getShippingAddress()
	// {
	// 	$shippingAddress = $this->getData('shippingAddress');
	// 	return $shippingAddress;
	// }


	public function getBillingAddress()	
	{
		$billingId = $this->getData('customer')->billing_address_id;
		if (!$billingId) {
			return Ccc::getModel('Customer_Address');
		}

		$billingAddress = Ccc::getModel('Customer_Address');
		$query = "SELECT * FROM `{$billingAddress->getResourceName()}` WHERE `{$billingAddress->getPrimaryKey()}` = '{$billingId}'";

		// print_r($billingAddress->fetchRow($query));
		return $billingAddress->fetchRow($query);
	}

	public function getShippingAddress()
	{
		$shippingId = $this->getData('customer')->shipping_address_id;
		if (!$shippingId) {
			return Ccc::getModel('Customer_Address');
		}

		$shippingAddress = Ccc::getModel('Customer_Address');
		$query = "SELECT * FROM `{$shippingAddress->getResourceName()}` WHERE `{$shippingAddress->getPrimaryKey()}` = '{$shippingId}'";

		return $shippingAddress->fetchRow($query);
	}

	public function getAddress()
	{
		$customerAddress = Ccc::getModel('Customer_Address');
		$query = "SELECT * FROM `{$customerAddress->getResourceName()}` WHERE `{$customerAddress->getPrimaryKey()}` = '{$this->customer_id}'";
		
		return $customerAddress->fetchRow($query);
	}
}

