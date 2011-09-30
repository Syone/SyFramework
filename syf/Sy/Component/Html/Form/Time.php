<?php
namespace Sy\Component\Html\Form;

class Time extends TextInput implements FillableElement {

	public function __construct() {
		parent::__construct('time');
	}

	public function fill($value) {
		if (is_array($value)) return;
		$this->setAttribute('value', $value);
	}

}