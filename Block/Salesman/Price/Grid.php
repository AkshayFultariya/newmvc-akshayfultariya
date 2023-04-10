<?php

class Block_Salesman_Price_Grid extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('salesman_price/grid.phtml');
	}
	public function getCollection()
	{
		// $salesmanId = $this->getRequest()->getParam('salesman_id');
		$salesmanId = (int)Ccc::getModel('Core_Request')->getParam('salesman_id');
		// $this->setSalesmanPriceId($salesmanId);

		$sql = "SELECT * FROM `salesman` ORDER BY `first_name` ASC";
		$salesmen = Ccc::getModel('Salesman_Price')->fetchAll($sql);

		$query = "SELECT P.*,SP.salesman_price FROM `product` P LEFT JOIN `salesman_price` SP ON P.product_id = SP.product_id AND SP.salesman_id = {$salesmanId}";
		$salesmanPrices = Ccc::getModel('Salesman_Price')->fetchAll($query);

		$s = [$salesmanId,$salesmen,$salesmanPrices];
		return $s;
	}
}

?>