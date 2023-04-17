<?php

class Block_Eav_Attribute_Grid extends Block_Core_Template
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('eav/attribute/grid.phtml');
	}

	public function getCollection()
	{
		$query = "SELECT * FROM `eav_attribute`";
		$data = Ccc::getModel('Eav_Attribute')->fetchAll($query);
		return $data;
	}
}

?>