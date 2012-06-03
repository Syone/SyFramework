<?php
namespace Sy\Debug;

class Log {

	const EMERG  = 0;  // Emergency: system is unusable
	const ALERT  = 1;  // Alert: action must be taken immediately
	const CRIT   = 2;  // Critical: critical conditions
	const ERR    = 3;  // Error: error conditions
	const WARN   = 4;  // Warning: warning conditions
	const NOTICE = 5;  // Notice: normal but significant condition
	const INFO   = 6;  // Informational: informational messages
	const DEBUG  = 7;  // Debug: debug messages

	private $levelNames = array(
		self::EMERG  => 'Emergency',
		self::ALERT  => 'Alert',
		self::CRIT   => 'Critical',
		self::ERR    => 'Error',
		self::WARN   => 'Warning',
		self::NOTICE => 'Notice',
		self::INFO   => 'Info',
		self::DEBUG  => 'Debug',
	);

	private $message;
	private $level;
	private $type;
	private $file;
	private $line;
	private $class;
	private $function;
	private $tag;
	private $time;

	/**
	 * Log constructor
	 *
	 * @param string $message
	 * @param array $info Optionnal associative array. Key available: level, type, file, line, function, class, message, tag
	 */
	public function __construct($info) {
		$this->message  = $this->getValueFromArray($info, 'message');
		$this->level    = $this->getValueFromArray($info, 'level', self::NOTICE);
		$this->type     = $this->getValueFromArray($info, 'type');
		$this->file     = $this->getValueFromArray($info, 'file');
		$this->line     = $this->getValueFromArray($info, 'line');
		$this->function = $this->getValueFromArray($info, 'function');
		$this->class    = $this->getValueFromArray($info, 'class');
		$this->tag      = $this->getValueFromArray($info, 'tag');
		$this->time     = time();

		if (empty($this->file) and empty($this->line) and empty($this->function) and empty($this->class)) {
			$this->initLogInfo();
		}
	}

	private function getValueFromArray($array, $key, $default = '') {
		return isset($array[$key]) ? $array[$key] : $default;
	}

	private function initLogInfo() {
		$callStack = debug_backtrace();
		$idx = 1;
		while (isset($callStack[$idx + 1]['class']) and $callStack[$idx + 1]['class'] === 'Sy\Object') $idx++;
		$this->file     = !empty($callStack[$idx]['file'])         ? $callStack[$idx]['file']         : '';
		$this->line     = !empty($callStack[$idx]['line'])         ? $callStack[$idx]['line']         : '';
		$this->function = !empty($callStack[$idx + 1]['function']) ? $callStack[$idx + 1]['function'] : '';
		$this->class    = !empty($callStack[$idx + 1]['class'])    ? $callStack[$idx + 1]['class']    : '';
	}

	public function getMessage() {
		return $this->message;
	}

	public function getLevel() {
		return $this->level;
	}

	public function getLevelName() {
		return $this->levelNames[$this->getLevel()];
	}

	public function getType() {
		return $this->type;
	}

	public function getFile() {
		return $this->file;
	}

	public function getLine() {
		return $this->line;
	}

	public function getClass() {
		return $this->class;
	}

	public function getFunction() {
		return $this->function;
	}

	public function getTag() {
		return $this->tag;
	}

	public function getTime() {
		return $this->time;
	}

}