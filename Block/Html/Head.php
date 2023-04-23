<?php

class Block_Html_Head extends Block_Core_Template
{
	protected $title = null;
	protected $javascript = [];
	protected $stylesheets = [];

	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('html/head.phtml');
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function setTitle($title)
	{
		 $this->title = $title;
		 return $this;
	}

	public function addJs($src)
	{
		$this->javascript[] = $src;
		return $this;
	}

	// public function getAllJs()
	// {
	// 	return $this->javascript
	// }
}

?>