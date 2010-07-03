<?php
namespace Sy\Form;

class Button extends Element {

	public function __construct() {
		parent::__construct('button');
	}

	public function fill($value) {
		return;
	}

	public function isValid($value) {
		return true;
	}
}
?>
