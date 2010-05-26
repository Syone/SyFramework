<?php
namespace Sy;

class Query {
	private $DBConnection;
	private $affected_rows;
	
	public function __construct($databaseID) {
		$this->DBConnection = ConnectionManager::getConnection($databaseID);
		
		// TODO: maybe check whether connection is retrieved.
		
		$this->affected_rows = 0;
	}
	
	public function query($query) {
		
	}
}
?>
