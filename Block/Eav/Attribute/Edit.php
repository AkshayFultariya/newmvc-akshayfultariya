<?php

class Block_Eav_Attribute_Edit extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('eav/attribute/edit.phtml');
	}
	
	public function getCollection()
	{
			// $attribute = Ccc::getModel('eav_attribute');
			// return $attribute;

		$attribute = $this->getData('attribute');
			return $attribute;
	}

	public function getAttributeOption()
	{
		$attributeId = Ccc::getModel('Core_Request')->getParam('attribute_id');
		// print_r($attributeId);
		// die();
		if (!$attributeId) {
			return Ccc::getModel('Eav_Attribute_Option');
		}
		$sql = "SELECT * FROM `eav_attribute_option` WHERE `attribute_id` = {$attributeId}";
		$attributeOptions = Ccc::getModel('Eav_Attribute_Option')->fetchAll($sql);
		return $attributeOptions->getData();
	}

// 	public function getEntityType()
   // {
   //    $sql = "SELECT `entity_type_id`,`name` FROM `entity_type`";
   //    return $this->getResource()->getAdapter()->fetchPairs($sql);
   // }
	
}

?>
