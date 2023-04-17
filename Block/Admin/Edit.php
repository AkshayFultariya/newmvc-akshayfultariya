<?php

class Block_admin_Edit extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('admin/edit.phtml');
	}

	public function getCollection()
	{
			$admin = $this->getData('admin');
			return $admin;
	}
	
}


?>
