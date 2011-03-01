<?php
namespace Sy\Component\Html\Form;

class Hidden extends TextElement {

	public function __construct() {
		parent::__construct('input');
	}

	public function isValid($value) {
		return $this->validate($value);
	}

	public function __toString() {
		$this->setAttribute('type', 'hidden');
		return parent::__toString();
	}
	
}