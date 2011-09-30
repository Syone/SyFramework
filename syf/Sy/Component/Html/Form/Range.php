<?php
namespace Sy\Component\Html\Form;

class Range extends TextInput implements FillableElement {

	public function __construct() {
		parent::__construct('range');
	}

	public function fill($value) {
		if (is_array($value)) return;
		$this->setAttribute('value', $value);
	}

}