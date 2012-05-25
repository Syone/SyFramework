<?php
namespace Sy\Db;

class Sql {

	private $sql;

	private $params;

	public function __construct($sql, $params = array()) {
		$this->sql = $sql;
		$this->params = $params;
	}
	
	public function getSql() {
		return $this->sql;
	}
	
	public function getParams() {
		return $this->params;
	}

}