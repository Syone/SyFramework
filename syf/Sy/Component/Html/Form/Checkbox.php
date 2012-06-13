<?php
namespace Sy\Component\Html\Form;

class Checkbox extends Input implements FillableElement, ValidableElement {

	public function __construct() {
		parent::__construct('checkbox');
		$this->setOption('label-position', 'after');
		$this->setOption('error-position', 'after');
	}

	public function fill($value) {
		if (is_null($value)) return;
		if (is_array($value)) {
			if (in_array($this->getAttribute('value'), $value, true))
				$this->setAttribute('checked', 'checked');
		}
		if ($this->getAttribute('value') == $value)
			$this->setAttribute('checked', 'checked');
	}

	public function isValid($value) {
		if ($this->isRequired()) {
			if (!isset($value) or $value === '') {
				return false;
			}
		}
		return true;
	}

}