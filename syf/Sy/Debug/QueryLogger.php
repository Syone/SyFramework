<?php
namespace Sy\Debug;

class QueryLogger implements ILogger {

	private $logs;

	public function __construct() {
		$this->logs = array();
	}

	public function write(Log $log){
		if ($log->getType() !== 'QueryLog') return;
		$this->logs[] = $log;
	}

	public function getLogs() {
		return $this->logs;
	}

}