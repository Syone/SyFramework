<?php
namespace Sy\Debug;

class Debugger {

	private static $instance;

	private $timeRecord;

	private $loggers;

	private $times;

	private $startTimes;

	private function __construct() {
		$this->timeRecord = false;
		$this->loggers    = array();
		$this->times      = array();
		$this->startTimes = array();
		$this->loggers    = array();
	}

	private function logActive() {
		if (isset($_GET['sy_debug_log']) and $_GET['sy_debug_log'] === 'off') return false;
		return !empty($this->loggers);
	}

	/**
	 * Activate web logging
	 */
	public function enableWebLog() {
		$this->loggers['web'] = new WebLogger();
	}

	/**
	 * Activate file logging
	 *
	 * @param string $file log file
	 * @param int $ttl
	 * @param string $dateFormat
	 */
	public function enableFileLog($file, $ttl = 90, $dateFormat = 'Y-m-d H:i:s') {
		$this->loggers['file'] = new FileLogger($file, $ttl, $dateFormat);
	}

	/**
	 * Activate time recording
	 */
	public function enableTimeRecord() {
		$this->timeRecord = true;
	}

	/**
	 * Return if the Web Logger is activated or not
	 *
	 * @return bool
	 */
	public function webLogActive() {
		return isset($this->loggers['web']);
	}

	/**
	 * Return if the File Logger is activated or not
	 *
	 * @return bool
	 */
	public function fileLogActive() {
		return isset($this->loggers['file']);
	}

	/**
	 * Return if the Time Record is activated or not
	 *
	 * @return bool
	 */
	public function timeRecordActive() {
		return $this->timeRecord;
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
	 * @param array $info Optionnal associative array. Key available: level, type, file, line, function, class, tag
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