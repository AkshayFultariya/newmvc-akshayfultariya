<?php

class Block_Eav_Attribute_Inputtype_Multiselect extends Block_Core_Template
{
	protected $attribute = null;

	public function setAttribute($attribute)
	{
		$this->attribute = $attribute;
		return $this;
	}	

	public function getAttribute()
	{
		return $this->attribute;
	}
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('eav/attribute/inputtype/multiselect.phtml');
	}
}

?>