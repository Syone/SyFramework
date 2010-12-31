<?php
namespace Sy;

class Debugger {

	public static $logs = array();

	public static function log($message, $level, $type) {
		self::$logs[] = new Log($message, $level, $type);
	}

	public static function getLogs() {
		return self::$logs;
	}

}