<?php

class Block_Product_Media_Edit extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		

		$this->setTemplate('product/media/add.phtml');
	}

	public function getCollection()
	{
		$productId = Ccc::getModel('Core_Request')->getParam('product_id');
		$product = Ccc::getModel('Product_Media');

		$final = [$productId, $product];
		return $final;
	}
	
}



?>
