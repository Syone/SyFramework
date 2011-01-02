<?php
namespace Sy;

class Debugger {

	private static $instance;

	private $logs;

	private $times;

	private $startTimes;

	private function __construct() {
		$this->logs = array();
		$this->times = array();
		$this->startTimes = array();
	}

	public static function getInstance() {
		if (!isset(self::$instance)) {
			$c = __CLASS__;
			self::$instance = new $c;
		}
		return self::$instance;
	}
	
	public function __clone() {
		trigger_error('Clone is not allowed.', E_USER_ERROR);
	}

	public function log($message, $level = Log::NOTICE, $type = NULL) {
		if (!defined('LOG') or LOG != 1) return;
		$this->logs[] = new Log($message, $level, $type);
	}

	public function getLogs() {
		return $this->logs;
	}

	public function getTimes() {
		return $this->times;
	}

	public function timeStart($id) {
		if (!defined('TIME_RECORD') and TIME_RECORD != 1) return;
		$this->startTimes[$id] = microtime(true);
	}
	
	public function timeStop($id) {
		if (!defined('TIME_RECORD') or TIME_RECORD != 1) return;
		if (!isset($this->startTimes[$id])) return;
		$end = microtime(true);
		$this->times[$id] = $end - $this->startTimes[$id];
	}

}