<?php
namespace Sy\Component\Html\Form;

class Date extends TextInput implements FillableElement {

	public function __construct() {
		parent::__construct('date');
	}

	public function fill($value) {
		if (is_array($value)) return;
		$this->setAttribute('value', $value);
	}

}