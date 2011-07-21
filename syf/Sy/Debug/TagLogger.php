<?php
namespace Sy\Debug;

class TagLogger implements ILogger {

	private $path;

	public function __construct($path) {
		$this->path = $path;
	}

	public function write(Log $log) {
		$tag = $log->getTag();
		if (empty($tag)) return;
		$file = $this->path . '/' . $tag;
		if (!file_exists(dirname($file))) mkdir(dirname($file), 0777, true);
		if (file_exists($file)) unlink($file);
		file_put_contents($file, $this->formatLog($log), FILE_APPEND | LOCK_EX);
	}

	/**
	 * Return formatted log message
	 *
	 * @param Log $log
	 */
	private function formatLog(Log $log) {
		$time     = date('Y-m-d H:i:s', $log->getTime());
		$level    = strtoupper($log->getLevelName());
		$type     = $log->getType();
		$class    = $log->getClass();
		$function = $log->getFunction();
		$file     = $log->getFile();
		$line     = $log->getLine();
		$message  = $log->getMessage();
		$msg = "--------------------------------------------------------------------------------\r\n";
		$msg .= "$time [$level]";
		if (!empty($type)) $msg .= "[$type]";
		if (!empty($class)) $msg .= "$class::";
		if (!empty($function)) $msg .= "$function() ";
		if (!empty($file)) $msg .= " in $file";
		if (!empty($line)) $msg .= " line $line \r\n";
		$msg .= "$message\r\n";
		return $msg;
	}

}