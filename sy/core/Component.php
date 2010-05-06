<?php
namespace Sy;

/**
 * Description of Component
 *
 * @author Syone
 */
class Component {

	public function __construct() {
		
	}

	public function setView() {
		
	}

	public function setFile() {
		
	}

	public function setVar() {
		
	}

	public function setComponent() {
		
	}

	public function getRender() {

	}

	public function render() {
		
	}

	/**
	 * Return the GET parameter named $param
	 * If the parameter is not set or is empty, return the default value
	 *
	 * @param string $param GET parameter name
	 * @param mixed $default The default value
	 * @return mixed
	 */
	protected function get($param, $default = NULL) {
		return (isset($_GET[$param]) and !empty($_GET[$param])) ? $_GET[$param] : $default;
	}

	/**
	 * Return the POST parameter named $param
	 * If the parameter is not set or is empty, return the default value
	 *
	 * @param string $param POST parameter name
	 * @param mixed $default The default value
	 * @return mixed
	 */
	protected function post($param, $default = NULL) {
		return (isset($_POST[$param]) and !empty($_POST[$param])) ? $_POST[$param] : $default;
	}

	/**
	 * Return the COOKIE parameter named $param
	 * If the parameter is not set or is empty, return the default value
	 *
	 * @param string $param COOKIE parameter name
	 * @param mixed $default The default value
	 * @return mixed
	 */
	protected function cookie($param, $default = NULL) {
		return (isset($_COOKIE[$param]) and !empty($_COOKIE[$param])) ? $_COOKIE[$param] : $default;
	}

	/**
	 * Return the REQUEST parameter named $param
	 * If the parameter is not set or is empty, return the default value
	 *
	 * @param string $param REQUEST parameter name
	 * @param mixed $default The default value
	 * @return mixed
	 */
	protected function request($param, $default = NULL) {
		return (isset($_REQUEST[$param]) and !empty($_REQUEST[$param])) ? $_REQUEST[$param] : $default;
	}

	/**
	 * Return the SESSION parameter named $param
	 * If the parameter is not set or is empty, return the default value
	 *
	 * @param string $param SESSION parameter name
	 * @param mixed $default The default value
	 * @return mixed
	 */
	protected function session($param, $default = NULL) {
		return (isset($_SESSION[$param]) and !empty($_SESSION[$param])) ? $_SESSION[$param] : $default;
	}

	protected function redirect($location = NULL) {

	}

	protected function actionDispatch($actionName, $defaultMethod = NULL) {
		
	}
}
?>
