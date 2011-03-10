<?php
namespace Sy\Debug;

class FileLogger implements ILogger {

	private $file;

	public function __construct($file) {
		$this->file = $file;
	}

	public function write(Log $log) {
		if (file_exists($this->file) and ((time() - filemtime($this->file)) > 90)) file_put_contents($this->file, '', LOCK_EX);
		file_put_contents($this->file, $this->formatLog($log), FILE_APPEND | LOCK_EX);
	}

	/**
	 * Return formatted log message
	 *
	 * @param Log $log
	 */
	private function formatLog(Log $log) {
		$msg = "--------------------------------------------------------------------------------\r\n";
		$msg .= '[' . strtoupper($log->getLevelName()) . '] ' . $log->getFile() . ' line ' . $log->getLine() . ' ' . $log->getClass() . ' ' . $log->getFunction() . "\r\n";
		$msg .= $log->getMessage() . "\r\n";
		return $msg;
	}

}