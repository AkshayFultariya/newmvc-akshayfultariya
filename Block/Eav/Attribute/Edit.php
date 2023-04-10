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
			$attribute = Ccc::getModel('eav_attribute');
			return $attribute;

		// $this->setTemplate('Eav_Attribute/edit.phtml')->setData(['Eav_Attribute' => $Eav_Attribute]);
	}
	
}


?>
