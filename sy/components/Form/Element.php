<?php
namespace Sy\Form;

use Sy\WebComponent;

class Element extends WebComponent {

	protected $tagName;
	protected $content;
	protected $attributes;
	protected $options;
	protected $error;

	public function __construct($tagName = '') {
		parent::__construct();
		$this->setTemplateFile(__DIR__ . '/templates/Element.tpl', 'php');
		$this->tagName = $tagName;
		$this->content = NULL;
		$this->attributes = array();
		$this->options = array();
		$this->error = false;
	}

	/**
	 * Set the element tag name
	 *
	 * @param string $tagName
	 */
	public function setTagName($tagName) {
		$this->tagName = $tagName;
	}

	/**
	 * Set the element content
	 *
	 * @param string $content
	 */
	public function setContent($content) {
		$this->content = $content;
	}

	/**
	 * Set the element attributes
	 *
	 * @param array $attributes
	 */
	public function setAttributes($attributes) {
		foreach ($attributes as $name => $value) {
			$this->setAttribute($name, $value);
		}
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
			$this->attributes[$name] = $value;
	}

	/**
	 * Get the element attributes
	 *
	 * @return array
	 */
	public function getAttributes() {
		return $this->attributes;
	}

	/**
	 * Get the element attribute
	 *
	 * @param string $name
	 * @return string
	 */
	public function getAttribute($name) {
		return isset($this->attributes[$name]) ? $this->attributes[$name] : NULL;
	}

	/**
	 * Set the element options
	 *
	 * @param array $options
	 */
	public function setOptions($options) {
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
		$this->options[$name] = $value;
	}

	/**
	 * Set the element name attribute
	 *
	 * @param string $name
	 */
	public function setName($name) {
		$begin = strstr($name, '[', true);
		if (!$begin) {
			$this->attributes['name'] = str_replace(array('.', ' '), '_', $name);
			return;
		}
		$new_begin = str_replace(array('.', ' '), '_', $begin);
		$end = strstr($name, '[');
		$new_end = str_replace('[]', '', $end);
		if (substr_compare($end, '[]', -2) == 0) {
			$new_end .= '[]';
		}
		$this->attributes['name'] = $new_begin.$new_end;
	}

	/**
	 * Return if the element is required or not
	 *
	 * @return boolean
	 */
	public function isRequired() {
		if (isset($this->attributes['required'])) return true;
		if (isset($this->options['required']))
			return $this->options['required'];
		else
			return false;
	}

	/**
	 * Add a validator
	 *
	 * @param callback $name
	 */
	public function addValidator($name) {
		$this->options['validator'][] = $name;
	}

	public function __toString() {
		$this->setVar('TAG_NAME', $this->tagName);
		$this->setVar('CONTENT', $this->content);
		$this->setVar('ERROR', $this->error);
		if ($this->getTemplateType() == 'php') {
			$this->setVar('ATTRIBUTES', $this->attributes);
			$this->setVar('OPTIONS', $this->options);
		}
		return parent::__toString();
	}
}