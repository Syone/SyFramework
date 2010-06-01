<?php
namespace Sy\Form;

class Container extends Element {
	
	protected $elements;

	public function __construct($name = '') {
		parent::__construct($name);
		$this->setTemplateFile('Container.tpl');
		$this->elements = array();
	}

	public function addElement($element) {
		$this->elements[] = $element;
		return $element;
	}

	public function __toString() {
		$this->setVar('ELEMENTS', $this->elements);
		return parent::__toString();
	}
}
?>
