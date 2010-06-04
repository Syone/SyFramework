<?php
namespace Sy;

class Component {

	/**
	 * Template engine
	 *
	 * @var ITemplate
	 */
	protected $template;

	public function __construct() {
		$this->template = TemplateProvider::createTemplate();
	}

	/**
	 * Use the php template engine
	 */
	public function usePhpTemplate() {
		$this->template = TemplateProvider::createTemplate('php');
	}

	/**
	 * Choose template files directory
	 *
	 * @param string $path
	 */
	public function setTemplateRoot($path) {
		$this->template->setRoot($path);
	}

	/**
	 * Set the main template file
	 *
	 * @param string $file
	 */
	public function setTemplateFile($file) {
		$this->template->setMainFile($file);
	}

	/**
	 * Set a value of a variable
	 *
	 * @param string $var
	 * @param string $value
	 * @param bool $append
	 */
	public function setVar($var, $value, $append = false) {
		$this->template->setVar($var, $value, $append);
	}

	/**
	 * Set a file contenat as the value of a variable
	 *
	 * @param string $var
	 * @param string $file
	 */
	public function setFile($var, $file) {
		$this->template->setFile($var, $file);
	}

	/**
	 * Parse a block
	 *
	 * @param string $block
	 */
	public function parseBlock($block) {
		$this->template->parseBlock($block);
	}

	/**
	 * Add a component
	 *
	 * @param string $where
	 * @param Component $component
	 * @param bool $append
	 */
	public function setComponent($where, $component, $append = false) {
		$this->template->setVar($where, $component->__toString(), $append);
	}

	/**
	 * Return the render of the component
	 *
	 * @return string
	 */
	public function  __toString() {
		return $this->template->getRender();
	}

	/**
	 * Render the component
	 */
	public function render() {
		echo $this->__toString();
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

	/**
	 * Dispatch an action to the appropriate method
	 *
	 * @param string $actionName
	 * @param string $defaultMethod
	 */
	protected function actionDispatch($actionName, $defaultMethod = NULL) {
		$method = $this->request($actionName, $defaultMethod);
		if (!empty($method) and method_exists($this, $method)) $this->$method();
	}
}
?>
