<?php

class Block_Item_Grid extends Block_Core_Template
{

	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('item/grid.phtml');
	}
	public function getCollection()
	{
		$query = "SELECT * FROM `item` ORDER BY `entity_id` DESC";
		$items = Ccc::getModel('Item')->fetchAll($query);
		return $items;
	}
}

?>