<?php

class Database {

	protected static $connection;
	private $host;
	private $username;
	private $password;
	private $dbname;
	
	public function connect() {
		if(!isset(self::$connection)) {
			$config = parse_ini_file('../config.ini');
			
			$host = 'localhost';
			$username = $config['username'];
			$password = $config['password'];
			$dbname = $config['dbname'];
			
			self::$connection = new mysqli($host, $username, $password, $dbname);
		}
		
		if(self::$connection === false)
		{
		  echo "Connection failed: " . $conn->connect_error;
			return false;
		}
			
		return self::$connection;
	}
	
	public function query($query) {
		$connection = $this->connect();
		
		$result = $connection->query($query);
		
		return $result;
	}
	
	public function select($query) {
		$rows = array();
		$result = $this->query($query);
		
		if($result === false) {
			return false;
		}
		
		while($row = $result->fetch_assoc()) {
			$rows[] = $row;
		}
	
		return $rows;
	}

	public function error() {
		$connection = $this->connect();
		
		return $connection->error();
	}
	
	public function quote($value) {
		$connection = $this->connect();
		
		return "'" . $connection->real_escape_string($value) . ".";
	}
}
?>