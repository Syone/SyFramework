<?php
namespace Sy\Component\Html\Form;

class Color extends TextInput implements FillableElement {

	public function __construct() {
		parent::__construct('color');
	}

	public function fill($value) {
		if (is_array($value)) return;
		$this->setAttribute('value', $value);
	}

}