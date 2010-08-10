<?php
namespace Sy\Form;

class Radio extends Element implements FillableElement, ValidableElement {

	public function __construct() {
		parent::__construct('input');
		$this->setAttribute('type', 'radio');
	}

	public function fill($value) {
		if ($this->getAttribute('value') == $value)
			$this->setAttribute('checked', 'checked');
	}

	public function isValid($value) {
		$valid = $this->validate($value);
		if (!$valid) $this->error = true;
		return $valid;
	}

	private function validate($value) {
		if ($this->isRequired()) {
			if (!isset($value) or $value === '') return false;
		}
		return true;
	}
}
?>
