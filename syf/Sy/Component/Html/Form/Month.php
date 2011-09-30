<?php
namespace Sy\Component\Html\Form;

class Month extends TextInput implements FillableElement {

	public function __construct() {
		parent::__construct('month');
	}

	public function fill($value) {
		if (is_array($value)) return;
		$this->setAttribute('value', $value);
	}

}