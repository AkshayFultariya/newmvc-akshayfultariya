<?php

class Block_Eav_Attribute_Inputtype_Select extends Block_Core_Template
{
	protected $attribute = null;
	protected $row = null;

	public function setAttribute($attribute)
	{
		$this->attribute = $attribute;
		return $this;
	}	

	public function getAttribute()
	{
		return $this->attribute;
	}

	public function setRow($row)
	{
		$this->row = $row;
		return $this;
	}	

	public function getRow()
	{
		return $this->row;
	}
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('eav/attribute/inputtype/select.phtml');
	}
}

?>