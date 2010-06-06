<?php
namespace Sy\Form;

class Container extends Element {
	
	protected $elements;

	public function __construct($name = '') {
		parent::__construct($name);
		$this->setTemplateFile(__DIR__ . '/templates/Container.tpl', 'php');
		$this->elements = array();
	}

	public function addElement($element) {
		$this->elements[] = $element;
		return $element;
	}

	public function __toString() {
		if ($this->getTemplateType() == 'php')
			$this->setVar('ELEMENTS', $this->elements);
		return parent::__toString();
	}
}
?>
