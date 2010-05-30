<?php
namespace Sy\Form;

class Container extends Element {

	protected $elements;

	public function __construct() {
		parent::__construct();
		$this->elements = array();
	}

	public function addElement($element) {
		$this->elements[] = $element;
	}

	public function addInput($attributes, $options = array()) {
		$input = new Input();
		$input->setAttributes($attributes);
		$input->setOptions($options);
		$this->addElement($input);
	}

	public function __toString() {
		$this->setVar('ELEMENTS', $this->elements);
		return parent::__toString();
	}
}
?>
