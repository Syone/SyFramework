<?php
namespace Sy\Component\Html\Form;

class Text extends TextInput implements FillableElement {

	public function __construct() {
		parent::__construct('text');
	}

	public function fill($value) {
		if (is_array($value)) return;
		$this->setAttribute('value', $value);
	}

}