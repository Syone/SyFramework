<?php
namespace Sy\Form;

use Sy\WebComponent;

abstract class Element extends WebComponent {

	protected $tagName;
	protected $content;
	protected $attributes;
	protected $options;

	public function __construct($tagName = '') {
		parent::__construct();
		$this->setTemplateFile(__DIR__ . '/templates/Element.tpl', 'php');
		$this->tagName = $tagName;
		$this->content = '';
		$this->attributes = array();
		$this->options = array();
	}

	public function setTagName($tagName) {
		$this->tagName = $tagName;
	}

	public function setContent($content) {
		$this->content = $content;
	}

	public function setAttributes($attributes) {
		foreach ($attributes as $name => $value) {
			$this->setAttribute($name, $value);
		}
	}

	public function setAttribute($name, $value) {
		$this->attributes[$name] = $value;
	}

	public function getAttribute($name) {
		return isset($this->attributes[$name]) ? $this->attributes[$name] : NULL;
	}

	public function setOptions($options) {
		foreach ($options as $name => $value) {
			$this->setOption($name, $value);
		}
	}

	public function setOption($name, $value) {
		$this->options[$name] = $value;
	}

	public function addValidator($name) {
		$this->options['validator'][] = $name;
	}

	public function __toString() {
		$this->setVar('TAG_NAME', $this->tagName);
		$this->setVar('CONTENT', $this->content);
		if ($this->getTemplateType() == 'php') {
			$this->setVar('ATTRIBUTES', $this->attributes);
			$this->setVar('OPTIONS', $this->options);
		}
		return parent::__toString();
	}

	abstract public function isValid($value);

	abstract public function fill($value);
}
?>
