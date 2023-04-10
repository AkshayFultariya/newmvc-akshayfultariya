<?php

class Model_Core_View
{
	
	protected $template = null;
	protected $data = [];

	function __construct()
	{

	}

	public function setTemplate($template)
	{
		$this->template = $template;
		return $this;
	}

	public function getTemplate()
	{
		return $this->template;
	}
	

	public function __unset($key)
	{
		unset($this->data[$key]);
	}

	public function __set($key,$value)
	{
		$this->data[$key] = $value;
	}

	public function __get($key)
	{
		if (!array_key_exists($key,$this->data)) {
			return null;
		}
		return $this->data[$key];
	}
	public function setData($data)
	{
		$this->data = $data;
		return $this;
	}

	public function getData()
	{
		return $this->data;
	}

	public function render()
	{
		require "View".DS.$this->getTemplate();
	}

	public function getUrl($controller=null,$action=null,$params=[],$resetParams=false)
	{
		return Ccc::getModel('Core_Url')->getUrl($controller,$action,$params,$resetParams);
	}
}

