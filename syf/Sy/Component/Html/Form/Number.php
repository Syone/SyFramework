<?php
namespace Sy\Component\Html\Form;

class Number extends TextInput implements FillableElement {

	public function __construct() {
		parent::__construct('number');
		$this->addValidator('Sy\\Component\\Html\\Form\\int');
	}

	public function fill($value) {
		if (is_array($value)) return;
		$this->setAttribute('value', $value);
	}

}