<?php
namespace Sy\Form;

class Password extends Element {

	public function __construct() {
		parent::__construct('input');
		$this->setAttribute('type', 'password');
	}

	public function fill($value) {

	}

	public function isValid($value) {
		return true;
	}
}
?>
