<?php

class Block_Brand_Edit extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('brand/edit.phtml')->getRow();
	}

	public function getRow()
	{
		$brand = $this->getData('brand');
		return $brand;
	}
	}
	


?>
