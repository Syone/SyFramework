<?php
namespace Sy;

class Component extends Object {

	/**
	 * Template engine
	 *
	 * @var ITemplate
	 */
	private $template;

	/**
	 * Template type
	 *
	 * @var string
	 */
	private $templateType;

	public function __construct() {
		$this->templateType = '';
		$this->template = TemplateProvider::createTemplate();
	}

	/**
	 * Return template type
	 *
	 * @return string
	 */
	public function getTemplateType() {
		return $this->templateType;
	}

	/**
	 * Set the template type
	 *
	 * @param string $type
	 */
	public function setTemplateType($type = '') {
		if ($this->templateType == $type) return;
		$this->templateType = $type;
		$this->template = TemplateProvider::createTemplate($type);
	}

	/**
	 * Set the main template file
	 *
	 * @param string $file
	 */
	public function setTemplateFile($file, $type = '') {
		if (!file_exists($file)) {
			$trace = debug_backtrace();
			$i = 0;
			while ($trace[$i + 1]['class'] != get_class($this)) $i++;
			$message = 'No such template file: ' . $file;
			$message .= ' in class ' . $trace[$i + 1]['class'];
			$message .= ' in method ' . $trace[$i + 1]['function'];
			$message .= ' in file ' . $trace[$i]['file'];
			$message .= ' on line ' . $trace[$i]['line'];
			$this->log($message , Log::ERR);
		}
		$this->setTemplateType($type);
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
	 * Set an array of values
	 *
	 * @param array $values associative array var => value
	 */
	public function setVars($values) {
		foreach ($values as $var => $value) {
			$this->setVar($var, $value);
		}
	}

	/**
	 * Parse a block
	 *
	 * @param string $block
	 */
	public function setBlock($block) {
		$this->template->setBlock($block);
	}

	/**
	 * Add a component
	 *
	 * @param string $where
	 * @param Component $component
	 * @param boolean $append
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
	 * Dispatch an action to the appropriate method
	 *
	 * @param string $actionName
	 * @param string $defaultMethod
	 */
	protected function actionDispatch($actionName, $defaultMethod = NULL) {
		$method = $this->request($actionName, $defaultMethod) . 'Action';
		if (is_null($method)) return;
		if (!method_exists($this, $method)) $method = $defaultMethod . 'Action';
		if (method_exists($this, $method)) $this->$method();
	}
	
}