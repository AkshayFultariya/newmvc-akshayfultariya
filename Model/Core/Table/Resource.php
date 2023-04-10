<?php

class Model_Core_Table_Resource
{

	protected $resourceName = null;
	protected $primaryKey  = null;
	protected $adapter = null;

	function __construct()
	{
		
	}

	public function setResourceName($resourceName){
		$this->resourceName = $resourceName;
		return $this;
	}
	
	public function getResourceName(){
		return $this->resourceName;
	}

	public function setPrimaryKey($primaryKey){
		$this->primaryKey = $primaryKey;
		return $this;
	}

	public function getPrimaryKey(){
		return $this->primaryKey;
	}

	protected function setAdapter($adapter){
		$this->adapter = $adapter;
		return $this;
	}

	public function getAdapter(){
		if ($this->adapter) {
			return $this->adapter;
		}
		$adapter = new Model_Core_Adapter();
		$this->setAdapter($adapter);
		return $adapter;


	}

	public function fetchAll($query){
		$result = $this->getAdapter()->fetchAll($query);
		if (!$result) {
			return false;
		}
		return $result;
	}

	public function fetchRow($query){
		if ($query) {
		return $this->getAdapter()->fetchRow($query);	
		}

		throw new Exception("Error Processing Request", 1);
		
	}

	public function insert($data){
		if ($data) {
			$keys = array_keys($data);
			$values = array_values($data);

			$keyData = '`'.implode('`,`', $keys).'`';
			$valueData ="'". implode("','", $values)."'";

			$query = "INSERT INTO `{$this->getResourceName()}`({$keyData}) VALUES ({$valueData})";

			return $this->getAdapter()->insert($query); 
		}
			throw new Exception("Error Processing Request", 1);
			
		}

	public function update($data,$conditions){
		
		if($data&&$conditions){
		foreach ($data as $key => $value) {
			$keys[] = "`$key` = '$value'";
		}

		$keyData = implode(',', $keys);

		foreach ($conditions as $key => $value) {
			$conditionArray[] = "`$key` = '$value'";
		}

		$keyString = implode('AND',$conditionArray);
		$query = "UPDATE `{$this->getResourceName()}` SET $keyData WHERE {$keyString}";
		return $this->getAdapter()->update($query);
	}
		throw new Exception("Error Processing Request", 1);	
	}

	public function delete($conditions){
		if($conditions){
		foreach ($conditions as $key => $value) {
			$conditionArray[] = " `$key` = '$value'";
		}

		$keyString = implode('AND',$conditionArray);

		$query = "DELETE FROM `{$this->getResourceName()}` WHERE {$keyString}";
		return $this->getAdapter()->delete($query);
	}
	throw new Exception("Error Processing Request", 1);
	
}

	public function load($value,$column=null){
		$column = (!column) ? $this->getPrimaryKey() : $column;
		$query = "SELECT * FROM `{$this->getTableName()}` WHERE `{$column}` = {$value}";
		$row = $this->getAdapter()->fetchRow($query);
		return $row;
	}
}

?>