<?php
namespace Sy\Db;

class Sql {

	private $sql;

	private $params;

	private $analysedParams;

	public function __construct($sql, $params = array()) {
		$this->sql = $sql;
		$this->params = $params;
		$this->analysedParams = array();
		$this->analyse();
	}

	public function getSql() {
		return $this->sql;
	}

	public function getParams() {
		return $this->params;
	}

	private function analyse() {
		if (empty($this->params)) return;
		if (is_numeric(key($this->params))) return;
		array_walk($this->params, array($this, 'analyseParam'));
		$this->params = $this->analysedParams;
	}

	private function analyseParam($value, $key) {
		if (!is_array($value) and !is_int($key)) {
			$this->analysedParams[$key] = $value;
			return;
		}
		$keys = array();
		foreach ($value as $k => $v) {
			$this->analysedParams[$key . $k] = $v;
			$keys[] = $key . $k;
		}
		$this->sql = str_replace($key, implode(',', $keys), $this->sql);
	}

}
