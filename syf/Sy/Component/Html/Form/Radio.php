<?php
namespace Sy\Component\Html\Form;

class Radio extends Input implements FillableElement, ValidableElement {

	public function __construct() {
		parent::__construct('radio');
		$this->setOption('label-position', 'after');
		$this->setOption('error-position', 'after');
	}

	public function fill($value) {
		if (is_null($value)) return;
		if ($this->getAttribute('value') == $value)
			$this->setAttribute('checked', 'checked');
	}

	public function isValid($value) {
		$valid = $this->validate($value);
		return $valid;
	}

	private function validate($value) {
		if ($this->isRequired()) {
			if (!isset($value) or $value === '') return false;
		}
		return true;
	}

}