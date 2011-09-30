<?php
namespace Sy\Component\Html\Form;

class Tel extends TextInput implements FillableElement {

	public function __construct() {
		parent::__construct('tel');
	}

	public function fill($value) {
		if (is_array($value)) return;
		$this->setAttribute('value', $value);
	}

}