<?php
namespace Sy\Component\Html\Form;

class Email extends TextElement implements FillableElement {

	public function __construct() {
		parent::__construct('input');
		$this->addValidator('Sy\\Component\\Html\\Form\\email');
	}

	public function fill($value) {
		if (is_array($value)) return;
		$this->setAttribute('value', $value);
	}

	public function __toString() {
		$this->setAttribute('type', 'email');
		return parent::__toString();
	}

}