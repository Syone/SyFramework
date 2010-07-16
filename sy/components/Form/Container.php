<?php
namespace Sy\Form;

class Container extends Element implements FillableElement, ValidableElement {
	
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

	public function fill($values) {
		foreach ($this->elements as $e) {
			if (!$e instanceof FillableElement) continue;
			if ($e instanceof Container) {
				$e->fill($values);
			} else {
				$name = $e->getAttribute('name');
				if (is_null($name)) continue;
				if (!isset($values[$name])) continue;
				$e->fill($values[$name]);
			}
		}
	}

	public function isValid($values) {
		foreach ($this->elements as $e) {
			if (!$e instanceof ValidableElement) continue;
			if ($e instanceof Container) {
				if (!$e->isValid($values)) return false;
			} else {
				$name = $e->getAttribute('name');
				if (is_null($name)) continue;
				if (!isset($values[$name]))$values[$name] = '';
				if (!$e->isValid($values[$name])) return false;
			}
		}
		return true;
	}

	public function __toString() {
		if ($this->getTemplateType() == 'php')
			$this->setVar('ELEMENTS', $this->elements);
		return parent::__toString();
	}
}
?>
