<?php

class Block_Category_Grid extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('category/grid.phtml');
	}
	public function getCollection()
	{
		$category = Ccc::getModel('Category');
		$query = "SELECT * FROM `{$category->getResource()->getResourceName()}` WHERE `parent_id` > 0 ORDER BY `path` ASC;";
		$categories = $category->fetchAll($query);
		return $categories;
	}
}

?>