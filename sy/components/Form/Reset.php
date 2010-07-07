<?php
namespace Sy\Form;

class Reset extends Element {
	
	public function __construct() {
		parent::__construct('input');
		$this->setAttribute('type', 'reset');
	}

	public function fill($value) {
		return;
	}

	public function isValid($value) {
		return true;
	}
}
?>
