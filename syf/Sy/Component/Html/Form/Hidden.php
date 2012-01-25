<?php
namespace Sy\Component\Html\Form;

class Hidden extends TextInput {

	public function __construct() {
		parent::__construct('hidden');
	}

	public function isValid($value) {
		return $this->validate($value);
	}

}