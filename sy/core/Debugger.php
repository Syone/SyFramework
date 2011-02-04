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

	/**
	 * Return formatted log message
	 *
	 * @param SyLog $log
	 */
	private function formatLog($log) {
		$msg = "--------------------------------------------------------------------------------\r\n";
		$msg .= '[' . strtoupper($log->getLevelName()) . '] ' . $log->getFile() . ' line ' . $log->getLine() . ' ' . $log->getClass() . ' ' . $log->getFunction() . "\r\n";
		$msg .= $log->getMessage() . "\r\n";
		return $msg;
	}

	/**
	 * Put the log message in a file
	 *
	 * @param SyLog $log
	 */
	private function logToFile($log) {
		if (isset($_GET['sy_debug_log']) and $_GET['sy_debug_log'] == 'off') return;
		if (!defined('LOG_FILE') or LOG_FILE == '') return;
		if (file_exists(LOG_FILE) and ((time() - filemtime(LOG_FILE)) > 30)) file_put_contents(LOG_FILE, '', LOCK_EX);
		file_put_contents(LOG_FILE, $this->formatLog($log), FILE_APPEND | LOCK_EX);
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
	 * @param string $message
	 * @param array $info Optionnal associative array. Key available: level, type, file, line, function, class
	 */
	public function log($message, $info = array()) {
		if (!defined('LOG') or LOG != 1) return;
		if (!isset($info['level'])) $info['level'] = SyLog::NOTICE;
		$log = new Log($message, $info);
		$this->logs[] = $log;
		$this->logToFile($log);
	}

	/**
	 * Return the number of error log
	 *
	 * @return int
	 */
	public function getNbError() {
		$i = 0;
		foreach ($this->logs as $log)
			if ($log->getLevel() <= Log::ERR) $i++;
		return $i;
	}

	/**
	 * Return logs array
	 *
	 * @return array
	 */
	public function getLogs() {
		return $this->logs;
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
		if (!defined('TIME_RECORD') or TIME_RECORD != 1) return;
		$this->startTimes[$id] = microtime(true);
	}

	/**
	 * Stop time record
	 *
	 * @param string $id time record identifier
	 */
	public function timeStop($id) {
		if (!defined('TIME_RECORD') or TIME_RECORD != 1) return;
		if (!isset($this->startTimes[$id])) return;
		$end = microtime(true);
		$this->times[$id] = $end - $this->startTimes[$id];
	}

}