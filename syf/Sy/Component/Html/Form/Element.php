<?php
namespace Sy\Component\Html\Form;

use Sy\Component\Html\Element as HtmlElement;

class Element extends HtmlElement {

	private $options;

	public function __construct($tagName = '') {
		parent::__construct($tagName);
		$this->setTemplateFile(__DIR__ . '/templates/Element.tpl', 'php');
		$this->setOptions(array('label-position' => 'before', 'error-position' => 'before', 'error-class' => 'error'));
	}

	/**
	 * Set the element attribute
	 *
	 * @param string $name attribute name
	 * @param string $value attribute value
	 */
	public function setAttribute($name, $value) {
		if ($name == 'name')
			$this->setName($value);
		else
			parent::setAttribute($name, $value);
	}

	/**
	 * Add a class to the element
	 *
	 * @param string $class
	 */
	public function addClass($class) {
		$actual = $this->getAttribute('class');
		$class = is_null($actual) ? $class : $actual . ' ' . $class;
		$this->setAttribute('class', $class);
	}

	/**
	 * Set error message
	 *
	 * @param string $error
	 */
	public function setError($error) {
		$this->setOption('error', $error);
	}

	/**
	 * Set the element options
	 *
	 * @param array $options
	 */
	public function setOptions(array $options) {
		foreach ($options as $name => $value) {
			$this->setOption($name, $value);
		}
	}

	/**
	 * Set the element option
	 *
	 * @param string $name option name
	 * @param mixed $value option value
	 */
	public function setOption($name, $value) {
		$name = strtoupper(str_replace('-', '_', $name));
		$this->options[$name] = $value;
	}

	/**
	 * Get the element option
	 *
	 * @param string $name
	 * @return mixed
	 */
	public function getOption($name) {
		$name = strtoupper(str_replace('-', '_', $name));
		return isset($this->options[$name]) ? $this->options[$name] : null;
	}

	/**
	 * Set the element name attribute
	 *
	 * @param string $name
	 */
	public function setName($name) {
		$begin = strstr($name, '[', true);
		if (!$begin) {
			parent::setAttribute('name', str_replace(array('.', ' '), '_', $name));
			return;
		}
		$new_begin = str_replace(array('.', ' '), '_', $begin);
		$end = strstr($name, '[');
		$new_end = str_replace('[]', '', $end);
		if ($end and substr_compare($end, '[]', -2) == 0) {
			$new_end .= '[]';
		}
		parent::setAttribute('name', $new_begin.$new_end);
	}

	/**
	 * Return if the element is required or not
	 *
	 * @return boolean
	 */
	public function isRequired() {
		if (!is_null($this->getAttribute('required'))) return true;
		if (!is_null($this->getOption('required')))
			return $this->getOption('required');
		else
			return false;
	}

	/**
	 * Add a validator
	 *
	 * @param callback $name
	 */
	public function addValidator($name) {
		$validators = $this->getOption('validator');
		$validators[] = $name;
		$this->setOption('validator', $validators);
	}

	public function __toString() {
		$this->setVar('ID', $this->getAttribute('id'));
		$this->setVars($this->options);
		return parent::__toString();
	}

}