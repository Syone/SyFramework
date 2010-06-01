<?php
namespace Sy;

class Query {
	private $DBConnection;
	private $affectedRows;
	private $PDOStatement;
	
	public function __construct($databaseID) {
		$this->DBConnection = ConnectionManager::getConnection($databaseID);
		
		// FIXME maybe check whether connection is retrieved.
		
		$this->affectedRows = 0;
	}
	
	public function execute($query, $params) {
		$ret = true;
		
		try {
			$this->PDOStatement = $this->DBConnection->prepare($query);
			$this->PDOStatement->execute($params);
			
			$this->affectedRows = $this->PDOStatement->rowCount();
		} catch (PDOException $e) {
			$ret = false;
		}
		
		return $ret;
	}
	
	public function fetch() {
		return $this->PDOStatement->fetch();
	}
	
	public function getStatement() {
		return $this->PDOStatement;
	}
}
?>
