<?php
namespace Sy\Debug;

class Debugger {

	private static $instance;

	private $log;

	private $timeRecord;

	private $loggers;

	private $times;

	private $startTimes;

	private function __construct() {
		$this->log = false;
		$this->timeRecord = false;
		$this->loggers = array();
		$this->times = array();
		$this->startTimes = array();
		$this->loggers[] = new Logger();
	}

	private function logActive() {
		if (isset($_GET['sy_debug_log']) and $_GET['sy_debug_log'] == 'off') return false;
		return $this->log;
	}

	/**
	 * Activate logging
	 */
	public function activateLog() {
		$this->log = true;
	}

	/**
	 * Activate time recording
	 */
	public function activateTimeRecord() {
		$this->timeRecord = true;
	}

	/**
	 * Activate file logging
	 *
	 * @param string $file log file
	 */
	public function activateFileLogger($file, $ttl = 90, $dateFormat = 'Y-m-d H:i:s') {
		$this->loggers['file'] = new FileLogger($file, $ttl, $dateFormat);
	}

	/**
	 * Return if the File Logger is activated or not
	 *
	 * @return bool
	 */
	public function hasFileLogger() {
		return isset($this->loggers['file']);
	}

	/**
	 * Add a logger
	 *
	 * @param ILogger $logger
	 */
	public function addLogger(ILogger $logger) {
		$this->loggers[] = $logger;
	}

	/**
	 * Return loggers
	 *
	 * @return array
	 */
	public function getLoggers() {
		return $this->loggers;
	}

	/**
	 * Singleton method
	 *
	 * @return Debugger
	 */
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

	/**
	 * Log a message
	 *
	 * @param string|array $message
	 * @param array $info Optionnal associative array. Key available: level, type, file, line, function, class
	 */
	public function log($message, array $info = array()) {
		if (!$this->logActive()) return;
		if (!isset($info['level'])) $info['level'] = Log::NOTICE;
		$info['message'] = is_array($message) ? print_r($message, true) : $message;
		$log = new Log($info);
		foreach ($this->loggers as $logger) {
			$logger->write($log);
		}
	}

	/**
	 * Return the number of error log
	 *
	 * @return int
	 */
	public function getNbError() {
		return $this->loggers[0]->getNbError();
	}

	/**
	 * Return logs array
	 *
	 * @return array
	 */
	public function getLogs() {
		return $this->loggers[0]->getLogs();
	}

	/**
	 * Return times array
	 *
	 * @return array
	 */
	public function getTimes() {
		return $this->times;
	}

	/**
	 * Start time record
	 *
	 * @param string $id time record identifier
	 */
	public function timeStart($id) {
		if (!$this->timeRecord) return;
		$this->startTimes[$id] = microtime(true);
	}

	/**
	 * Stop time record
	 *
	 * @param string $id time record identifier
	 */
	public function timeStop($id) {
		if (!$this->timeRecord) return;
		if (!isset($this->startTimes[$id])) return;
		$end = microtime(true);
		$this->times[$id] = $end - $this->startTimes[$id];
	}

}