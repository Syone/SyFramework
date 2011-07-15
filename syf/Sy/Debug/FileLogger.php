<?php
namespace Sy\Debug;

class FileLogger implements ILogger {

	private $file;
	private $ttl;

	public function __construct($file, $ttl) {
		$this->file = $file;
		$this->ttl = $ttl;
	}

	public function write(Log $log) {
		if (!file_exists(dirname($this->file))) {
			mkdir(dirname($this->file), 0777, true);
		}
		if (file_exists($this->file) and ((time() - filemtime($this->file)) > $this->ttl)) {
			file_put_contents($this->file, '', LOCK_EX);
		}
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