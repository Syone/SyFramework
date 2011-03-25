<?php
namespace Sy;
use Sy\Debug\Debugger, Sy\Debug\Log;

class Object {

	/**
	 * Log a message
	 *
	 * @param string $message
	 * @param array info Optionnal associative array. Key available: level, type, file, line, function, class
	 */
	public function log($message, array $info = array()) {
		$debugger = Debugger::getInstance();
		if (!isset($info['type'])) $info['type'] = get_class($this);
		$debugger->log($message, $info);
	}

	/**
	 * Log a warning message
	 *
	 * @param string $message
	 * @param array $info Optionnal associative array. Key available: type, file, line, function, class
	 */
	public function logWarning($message, array $info = array()) {
		$info['level'] = Log::WARN;
		$this->log($message, $info);
	}

	/**
	 * Log an error message
	 *
	 * @param string $message
	 * @param array $info Optionnal associative array. Key available: type, file, line, function, class
	 */
	public function logError($message, array $info = array()) {
		$info['level'] = Log::ERR;
		$this->log($message, $info);
	}

	/**
	 * Return debug backtrace informations
	 *
	 * @return array
	 */
	public function getDebugTrace() {
		$trace = debug_backtrace();
		$i = 1;
		$res['class'] = $trace[$i + 1]['class'];
		$res['function'] = $trace[$i + 1]['function'];
		$res['file'] = $trace[$i]['file'];
		$res['line'] = $trace[$i]['line'];
		return $res;
	}

	/**
	 * Start time record
	 *
	 * @param string $id time record identifier
	 */
	public function timeStart($id) {
		$debugger = Debugger::getInstance();
		$debugger->timeStart($id);
	}

	/**
	 * Stop time record
	 *
	 * @param string $id time record identifier
	 */
	public function timeStop($id) {
		$debugger = Debugger::getInstance();
		$debugger->timeStop($id);
	}

	/**
	 * Return the GET parameter named $param
	 * If the parameter is not set, return the default value
	 *
	 * @param string $param GET parameter name
	 * @param mixed $default The default value
	 * @return mixed
	 */
	protected function get($param, $default = NULL) {
		return isset($_GET[$param]) ? $_GET[$param] : $default;
	}

	/**
	 * Return the POST parameter named $param
	 * If the parameter is not set, return the default value
	 *
	 * @param string $param POST parameter name
	 * @param mixed $default The default value
	 * @return mixed
	 */
	protected function post($param, $default = NULL) {
		return isset($_POST[$param]) ? $_POST[$param] : $default;
	}

	/**
	 * Return the COOKIE parameter named $param
	 * If the parameter is not set, return the default value
	 *
	 * @param string $param COOKIE parameter name
	 * @param mixed $default The default value
	 * @return mixed
	 */
	protected function cookie($param, $default = NULL) {
		return isset($_COOKIE[$param]) ? $_COOKIE[$param] : $default;
	}

	/**
	 * Return the REQUEST parameter named $param
	 * If the parameter is not set, return the default value
	 *
	 * @param string $param REQUEST parameter name
	 * @param mixed $default The default value
	 * @return mixed
	 */
	protected function request($param, $default = NULL) {
		return isset($_REQUEST[$param]) ? $_REQUEST[$param] : $default;
	}

	/**
	 * Return the SESSION parameter named $param
	 * If the parameter is not set, return the default value
	 *
	 * @param string $param SESSION parameter name
	 * @param mixed $default The default value
	 * @return mixed
	 */
	protected function session($param, $default = NULL) {
		return isset($_SESSION[$param]) ? $_SESSION[$param] : $default;
	}

	/**
	 * Redirect to location
	 * if location is null, redirect to http referer
	 * if http referer is not set, do nothing
	 *
	 * @param string $location
	 */
	protected function redirect($location = NULL) {
		if (empty($location)) {
			if (isset($_SERVER['HTTP_REFERER']))
				header('location:' . $_SERVER['HTTP_REFERER']);
		}
		else {
			header('location:' . $location);
		}
		exit();
	}

}