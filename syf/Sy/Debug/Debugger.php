<?php
namespace Sy\Debug;

class Debugger {

	private static $instance;

	private $phpInfo;

	private $timeRecord;

	private $loggers;

	private $times;

	private $startTimes;

	private function __construct() {
		$this->phpInfo    = false;
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
	 * Activate PHP info
	 */
	public function enablePhpInfo() {
		$this->phpInfo = true;
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
	 * Activate tag logging
	 *
	 * @param string $path directory where tagged logs are stored
	 */
	public function enableTagLog($path) {
		$this->loggers['tag'] = new TagLogger($path);
	}

	/**
	 * Activate query logging
	 */
	public function enableQueryLog() {
		$this->loggers['query'] = new QueryLogger();
	}

	/**
	 * Activate time recording
	 */
	public function enableTimeRecord() {
		$this->timeRecord = true;
	}

	/**
	 * Return if PHP info is activated or not
	 *
	 * @return bool
	 */
	public function phpInfoActive() {
		return $this->phpInfo;
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
	 * Return if the Query Logger is activated or not
	 *
	 * @return bool
	 */
	public function queryLogActive() {
		return isset($this->loggers['query']);
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
		$info['message'] = is_array($message) ? print_r($message, true) : $message;
		$log = new Log($info);
		foreach ($this->loggers as $logger) {
			if (isset($info['type']) and $info['type'] === 'QueryLog' and !($logger instanceof QueryLogger) and !($logger instanceof FileLogger)) continue;
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