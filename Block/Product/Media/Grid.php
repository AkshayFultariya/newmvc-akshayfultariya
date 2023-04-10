<?php

class Block_Product_Media_Grid extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('product/media/grid.phtml');
	}
	public function getMedias()
	{
		$productId = Ccc::getModel('Core_Request')->getParam('product_id');
		$query = "SELECT * FROM `media` ORDER BY `media_id` DESC";
		$medias = Ccc::getModel('Product_Media')->fetchAll($query);
		// print_r($medias);
		// die();
    			// die();

		$pro = [$medias,$productId];

		return $pro;
	}
}

?>