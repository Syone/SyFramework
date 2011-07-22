<?php
namespace Sy\Debug;

class FileLogger implements ILogger {

	private $file;
	private $ttl;
	private $dateFormat;

	public function __construct($file, $ttl, $dateFormat) {
		$this->file = $file;
		$this->ttl = $ttl;
		$this->dateFormat = $dateFormat;
	}

	public function getFile() {
		return $this->file;
	}

	public function getLogs() {
		return file_exists($this->file) ? file_get_contents($this->file) : '';
	}

	public function clearLogs() {
		if (file_exists($this->file)) unlink($this->file);
	}

	public function write(Log $log) {
		if (!file_exists(dirname($this->file))) {
			mkdir(dirname($this->file), 0777, true);
		}
		if (file_exists($this->file) and ((time() - filemtime($this->file)) > $this->ttl)) {
			unlink($this->file);
		}
		file_put_contents($this->file, $this->formatLog($log), FILE_APPEND | LOCK_EX);
	}

	/**
	 * Return formatted log message
	 *
	 * @param Log $log
	 */
	private function formatLog(Log $log) {
		$time     = date($this->dateFormat, $log->getTime());
		$level    = strtoupper($log->getLevelName());
		$type     = $log->getType();
		$class    = $log->getClass();
		$function = $log->getFunction();
		$file     = $log->getFile();
		$line     = $log->getLine();
		$message  = $log->getMessage();
		$msg = "--------------------------------------------------------------------------------\r\n";
		$msg .= "$time [$level]";
		if (!empty($type))     $msg .= "[$type]";
		if (!empty($class))    $msg .= " $class::";
		if (!empty($function)) $msg .= "$function()";
		if (!empty($file))     $msg .= " in $file";
		if (!empty($line))     $msg .= " line $line \r\n";
		$msg .= "$message\r\n";
		return $msg;
	}

}