<?php
namespace Sy;

class Debugger {

	private static $logs = array();

	private static $times = array();

	public static function log($message, $level, $type) {
		self::$logs[] = new Log($message, $level, $type);
	}

	public static function getLogs() {
		return self::$logs;
	}

	public static function getTimes() {
		return self::$times;
	}

	public static function startTimer($key) {
		self::$times[$key] = microtime(true);
	}
	
	public static function stopTimer($key) {
		$end = microtime(true);
		self::$times[$key] = $end - self::$times[$key];
	}

}