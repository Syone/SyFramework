<?php
namespace Sy\Db;

class Table extends \Sy\Db implements ITable {

	private $name;

	public function __construct($name, $dsn, $username = '', $passwd = '', $options = array()) {
		parent::__construct($dsn, $username, $passwd, $options);
		$this->name = $name;
	}

	public function getRows() {
		$sql = "SELECT * FROM $this->name";
		return $this->queryAll($sql, \PDO::FETCH_ASSOC);
	}

}