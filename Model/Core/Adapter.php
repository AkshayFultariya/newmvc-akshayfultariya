<?php

class Model_Core_Adapter
{
	public $config = [
		'host' => 'localhost',
		'username' => 'root',
		'password' => '',
		'dbname' => 'newmvc-akshayFultariya',
	];

	public $connect = null;

	public function connect(){
		if ($this->connect != null) {
			return $this->connect; 
		}
		$connect = mysqli_connect(
			$this->config['host'],
			$this->config['username'],
			$this->config['password'],
			$this->config['dbname']
		);
		$this->connect = $connect;
		return $connect;
	}

	public function query($sql)
	{
		$connect = $this->connect();
		return $connect->query($sql);
	}

	public function insertUpdateOnDuplicate($arrayData,$uniqueColumns)
	{
		$keyString = '`'.implode('`,`',array_keys($arrayData)).'`';
		$valueString = "'".implode("','",array_values($arrayData))."'";
		$sql = "INSERT INTO `{$this->getResourceName()}` ({$keyString}) VALUES ({$valueString})";
	}

	public function fetchAll($query){
		$connect = $this->connect();
		$result = mysqli_query($connect,$query);
		if ($result->num_rows == 0) {
			return false;
		}
			return $result->fetch_all(MYSQLI_ASSOC);
	}

	public function fetchRow($query){
		$connect = $this->connect();
		$result = mysqli_query($connect,$query);
		if ($result->num_rows == 0) {
			return 	false;
		}
			return $result->fetch_assoc();
	}

	public function fetchPairs($query)
	{
		$connect = $this->connect();
		$result = mysqli_query($connect,$query);
		if ($result->num_rows == 0) {
			return false;
		}

		$data = $result->fetch_all();
		$column1 = array_column($data,'0');
		$column2 = array_column($data,'1');
		if (!$column2) {
			$column2 = array_fill(0, count($column1), null);
		}
		return array_combine($column1,$column2);
	}

	public function fetchOne($query)
	{
		$connect = $this->connect();
		$result = mysqli_query($connect,$query);
		if ($result->num_rows == 0) {
			return null;
		}

		$row = $result->fetch_array();
		if ($row) {
		return (array_key_exists(0, $row)) ? $row[0] : null;
		}
	}

	public function insert($query){
		$connect = $this->connect();
		$result = mysqli_query($connect,$query);
		if ($result) {
			return $connect->insert_id;
		}
			return false;
	}

	public function update($query){
		$connect = $this->connect();
		$result = mysqli_query($connect,$query);
		if ($result) {
			return true;
		}
			return false;
	}

	public function delete($query){
		$connect = $this->connect();
		$result = mysqli_query($connect,$query);
		if ($result) {
			return true;
		}
			return false;
	}
}


