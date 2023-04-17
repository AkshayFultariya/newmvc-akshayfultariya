<?php


class Block_Eav_Attribute_Inputtype extends Block_Core_Template
{
	protected $attribute = null;
	protected $row = null;

	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('eav/attribute/inputtype.phtml');
	}

	public function setAttributes($attribute)
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

	public function getInputtypeField()
	{
		$attribute = $this->getAttribute();
		if ($attribute->input_type == 'text') {
			return $this->getLayout()->createBlock('Eav_Attribute_Inputtype_Text')->setAttribute($this->getAttribute());
		}

		elseif ($attribute->input_type == 'textarea') {
			return $this->getLayout()->createBlock('Eav_Attribute_Inputtype_Textarea')->setAttribute($this->getAttribute());
		}

		elseif ($attribute->input_type == 'select') {
			return $this->getLayout()->createBlock('Eav_Attribute_Inputtype_Select')->setAttribute($this->getAttribute());
		}

		elseif ($attribute->input_type == 'multiselect') {
			return $this->getLayout()->createBlock('Eav_Attribute_Inputtype_Multiselect')->setAttribute($this->getAttribute());
		}

		else{
			echo "No String";
		}
	}
}

?>