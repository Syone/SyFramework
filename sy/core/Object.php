<?php
namespace Sy;

class Object {

	/**
	 * Log a message
	 *
	 * @param mixed $message
	 * @param integer $level
	 */
	public function log($message, $level = Log::DEBUG) {
		Debugger::log($message, $level, get_class($this));
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
		if (is_null($default))
			return isset($_GET[$param]) ? $_GET[$param] : $default;
		else
			return (isset($_GET[$param]) and !empty($_GET[$param])) ? $_GET[$param] : $default;
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
		if (is_null($default))
			return isset($_POST[$param]) ? $_POST[$param] : $default;
		else
			return (isset($_POST[$param]) and !empty($_POST[$param])) ? $_POST[$param] : $default;
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
		if (is_null($default))
			return isset($_COOKIE[$param]) ? $_COOKIE[$param] : $default;
		else
			return (isset($_COOKIE[$param]) and !empty($_COOKIE[$param])) ? $_COOKIE[$param] : $default;
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
		if (is_null($default))
			return isset($_REQUEST[$param]) ? $_REQUEST[$param] : $default;
		else
			return (isset($_REQUEST[$param]) and !empty($_REQUEST[$param])) ? $_REQUEST[$param] : $default;
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
		if (is_null($default))
			return isset($_SESSION[$param]) ? $_SESSION[$param] : $default;
		else
			return (isset($_SESSION[$param]) and !empty($_SESSION[$param])) ? $_SESSION[$param] : $default;
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
	}

}