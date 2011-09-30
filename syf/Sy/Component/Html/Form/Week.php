<?php
namespace Sy\Component\Html\Form;

class Week extends TextInput implements FillableElement {

	public function __construct() {
		parent::__construct('week');
	}

	public function fill($value) {
		if (is_array($value)) return;
		$this->setAttribute('value', $value);
	}

}