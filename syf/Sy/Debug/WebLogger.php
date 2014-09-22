<?php
namespace Sy\Debug;

class WebLogger implements ILogger {

	private $logs;

	public function __construct() {
		$this->logs = array();
	}

	public function write(Log $log) {
		$this->logs[] = $log;
	}

	public function getLogs() {
		return $this->logs;
	}

	public function getNbError() {
		$i = 0;
		foreach ($this->logs as $log) {
			if ($log->getLevel() <= Log::ERR) ++$i;
		}
		return $i;
	}

}