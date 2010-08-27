<?php
namespace Sy\Form;

class Hidden extends TextElement {

	public function __construct() {
		parent::__construct('input');
		$this->setAttribute('type', 'hidden');
	}

	public function isValid($value) {
		return $this->validate($value);
	}
	
}