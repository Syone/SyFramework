<?php
namespace Sy\Form;

use Sy\WebComponent;

class Element extends WebComponent {

	protected $name;
	protected $content;
	protected $attributes;
	protected $options;

	public function __construct($name = '') {
		parent::__construct();
		$this->setTemplateFile(__DIR__ . '/templates/Element.tpl', 'php');
		$this->name = $name;
		$this->content = '';
		$this->attributes = array();
		$this->options = array();
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function setContent($content) {
		$this->content = $content;
	}

	public function setAttributes($attributes) {
		$this->attributes = $attributes;
	}

	public function setAttribute($name, $value) {
		$this->attributes[$name] = $value;
	}

	public function setOptions($options) {
		$this->options = $options;
	}

	public function setOption($name, $value) {
		$this->options[$name] = $value;
	}

	public function __toString() {
		$this->setVar('NAME', $this->name);
		$this->setVar('CONTENT', $this->content);
		if ($this->getTemplateType() == 'php') {
			$this->setVar('ATTRIBUTES', $this->attributes);
			$this->setVar('OPTIONS', $this->options);
		}
		return parent::__toString();
	}
}
?>
