<?php
namespace Sy;

class Database {
	private $driver;
	private $host;
	private $database;
	private $username;
	private $password;
	private $dbh;
	
	public function __construct($driver, $host, $database, $username, $password) {
		$this->driver = $driver;
		$this->host = $host;
		$this->database = $database;
		$this->username = $username;
		$this->password = $password;
	}
	
	public function connect() {
		$connected = false;
		
		try {
			$this->dbh = new PDO($this->driver.':dbname='.$this->database.';host='.$this->host, $this->username, $this->password);
			$connected = true;
		} catch (DOException $e) {
			// ERROR: failed to create connection to database.
		}
		
		return $connected;
	}
}
?>
