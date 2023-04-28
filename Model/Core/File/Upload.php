<?php

class Model_Core_File_Csv
{
	protected $file = null;	
	protected $fileName = null;	
	protected $path = 'var';	
	protected $extentions = ['csv'];	

	public function save()
	{
		if (!array_key_exists($name,$_FILES)) {
			return $this;
		}

		$this->file = $_FILES[$name];

		if (!$this->getFileName()) {
			$this->setFileName($this->file = $_FILES[$name]);
		}

		move_uploaded_file($this->file['tmp_name'],$this->getPath().DS.$this->getFileName());
		return $this;
	}

	public function getPath()
	{
		return $this->path;
	}

	public function setPath($subPath)
	{
		if ($subPath) {
			$this->path = Ccc::getBaseDir();
		}
		return $this;
	}

	public function getExtentions()
	{
		return $this->extentions;
	}

	public function setExtentions(array $extentions)
	{
		$this->extentions = $extentions;
		return $this;
	}

	public function getFileName()
	{
		return $this->fileName;
	}

	public function setFileName($fileName)
	{
		$this->fileName = $fileName;
		return $this
	}

	public function getFile()
	{
		return $this->file;
	}

	public function setFile($file)
	{
		$this->file = $file;
		return $this
	}
}