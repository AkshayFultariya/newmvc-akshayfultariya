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
		$query = "SELECT count(`attribute_id`) FROM `eav_attribute`";
		$totalRecord = Ccc::getModel('Core_Adapter')->fetchOne($query);

		$this->getPager()->setTotalRecords($totalRecord)->calculate();

		$query = "SELECT * FROM `eav_attribute` LIMIT {$this->getPager()->startLimit},{$this->getPager()->recordPerPage}";
		$data = Ccc::getModel('Eav_Attribute')->fetchAll($query);
		return $data;
	}
}

?>