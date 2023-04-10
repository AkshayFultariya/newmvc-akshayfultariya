<?php

class Block_Product_Edit extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('product/edit.phtml');
		
	}
	

	public function getCollection()
	{
		if ($id = (int)Ccc::getModel('Core_Request')->getParam('product_id')) {
		$product = Ccc::getModel('Product')->load($id);
		return $product;
		}
		else{
			$product = Ccc::getModel('product');

			// print_r($product);
		// die();
			return $product;
		// print_r($this->getData('product'));
		// return $this->getData('product');

		// $this->setTemplate('product/edit.phtml')->setData(['product' => $product]);
	}
	

}
}

?>
