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
			if ($id = (int)Ccc::getModel('Core_Request')->getParam('admin_id')) {
			$admin = Ccc::getModel('Admin')->load($id);
			return $admin;
		}
		else{
			$admin = Ccc::getModel('Admin');
			return $admin;

		// $this->setTemplate('admin/edit.phtml')->setData(['admin' => $admin]);
	}
	
}
}

?>
