<?php
namespace Sy;

class Debugger {

	private static $logs = array();

	public static function log($message, $level, $type) {
		self::$logs[] = new Log($message, $level, $type);
	}

}