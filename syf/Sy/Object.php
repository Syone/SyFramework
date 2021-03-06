<?php
namespace Sy;

use Sy\Debug\Debugger,
	Sy\Debug\Log;

class Object {

	/**
	 * Log a message
	 *
	 * @param string|array $message
	 * @param array info Optionnal associative array. Key available: level, type, file, line, function, class, tag
	 */
	public function log($message, array $info = array()) {
		$debugger = Debugger::getInstance();
		if (!isset($info['type'])) $info['type'] = get_class($this);
		$debugger->log($message, $info);
	}

	/**
	 * Log a warning message
	 *
	 * @param string|array $message
	 * @param array $info Optionnal associative array. Key available: type, file, line, function, class, tag
	 */
	public function logWarning($message, array $info = array()) {
		$info['level'] = Log::WARN;
		$this->log($message, $info);
	}

	/**
	 * Log an error message
	 *
	 * @param string|array $message
	 * @param array $info Optionnal associative array. Key available: type, file, line, function, class, tag
	 */
	public function logError($message, array $info = array()) {
		$info['level'] = Log::ERR;
		$this->log($message, $info);
	}

	/**
	 * Log a sql query and its parameters
	 *
	 * @param string|Sy\Db\Sql $sql
	 * @param array $info Optionnal associative array. Key available: type, file, line, function, class, message, tag
	 */
	public function logQuery($sql, array $info = array()) {
		$query  = $sql;
		$params = array();
		if ($sql instanceof Db\Sql) {
			$params = $sql->getParams();
			$query  = $sql->getSql();
		}
		$parameters = empty($params) ? '' : "Parameters:\n" . print_r($params, true);
		$message = isset($info['message']) ? $info['message'] : '';
		if (!isset($info['type'])) $info['type'] = 'Query';
		$this->log("Query:\n$query\n$parameters\n$message", $info);
	}

	/**
	 * Log a tagged message. A tagged message will be stored in a tag named file.
	 *
	 * @param string|array $message
	 * @param string $tag
	 * @param array $info Optionnal associative array. Key available: type, file, line, function, class, message, tag
	 */
	public function logTag($message, $tag, array $info = array()) {
		$info['tag'] = $tag;
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
		if (!isset($trace[$i + 1])) $i--;
		$res['class']    = isset($trace[$i + 1]['class'])    ? $trace[$i + 1]['class']    : '';
		$res['function'] = isset($trace[$i + 1]['function']) ? $trace[$i + 1]['function'] : '';
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
	protected function get($param, $default = null) {
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
	protected function post($param, $default = null) {
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
	protected function cookie($param, $default = null) {
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
	protected function request($param, $default = null) {
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
	protected function session($param, $default = null) {
		return isset($_SESSION[$param]) ? $_SESSION[$param] : $default;
	}

	/**
	 * Redirect to location
	 *
	 * @param string $location
	 */
	protected function redirect($location) {
		header('location:' . $location);
		exit();
	}

}