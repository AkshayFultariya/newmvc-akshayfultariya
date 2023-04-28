<?php

class Model_Core_File_Csv
{
	protected $file = null;	
	protected $handler = null;	
	protected $fileName = null;	
	protected $path = 'var';	
	protected $header = [];	
	protected $rows = [];

	public function read()
	{
		$this->open();

		while ($row = fgetcsv($this->getHeader(),1024))
	    {
			if (!$this->header) {
				$this->header = $row;
			}
			else{
				$this->row[] = array_combine($this->header,$row);
			}
		}

		$this->close();
		return $this;
	}

	public function open()
	{
		$fileName = $this->getPath().DS.$this->getFileName();
		$this->handler = fopen($fileName,"r");
		return $this;
	}

	public function close()
	{
		if ($this->getHandler()) {
			fclose($this->gethandler());
		}
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

	public function getHandler()
	{
		return $this->handler;
	}

	public function setHandler($handler)
	{
		$this->handler = $handler;
		return $this
	}

	public function getHeader()
	{
		return $this->header;
	}

	public function setHeader($header)
	{
		$this->header = $header;
		return $this
	}



}