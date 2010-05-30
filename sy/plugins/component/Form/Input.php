<?php
namespace Sy\Form;

class Input extends Element {

	private $options;

	public function __construct() {
		parent::__construct();
		$this->usePhpTemplate();
		$this->setTemplateRoot(__DIR__ . '/templates');
		$this->setTemplateFile('Input.tpl');
		$this->options = array();
	}

	public function setOptions($options) {
		$this->options = $options;
	}

	public function __toString() {
		$this->setVar('OPTIONS', $this->options);
		return parent::__toString();
	}
}
?>
