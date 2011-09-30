<?php
namespace Sy\Component\Html\Form;

class Email extends TextInput implements FillableElement {

	public function __construct() {
		parent::__construct('email');
		$this->addValidator('Sy\\Component\\Html\\Form\\email');
	}

	public function fill($value) {
		if (is_array($value)) return;
		$this->setAttribute('value', $value);
	}

}