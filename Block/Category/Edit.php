<?php

class Block_category_Edit extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('category/edit.phtml');
		
	}

	public function getRow()
	{
		return  $this->category;
		
	}

	public function getAttributes()
	{
		$attributes = Ccc::getModel('Category')->getAttributes();
		return $attributes;
	}
	
}


?>
