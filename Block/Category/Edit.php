<?php

class Block_category_Edit extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('category/edit.phtml');
		
	}
	

	public function getCollection()
	{
			if ($id = (int)Ccc::getModel('Core_Request')->getParam('category_id')) {
			$category = Ccc::getModel('Category')->load($id);
			return $category;
		}
		else{
		$category = Ccc::getModel('Category');
		return $category;

		// $this->setTemplate('category/edit.phtml')->setData(['category' => $category]);
	}
	
}
}

?>
