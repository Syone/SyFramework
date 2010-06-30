<?php
namespace Sy\Form;

class Submit extends Element {
	
	public function __construct() {
		parent::__construct('input');
		$this->setAttribute('type', 'submit');
	}

	public function fill($value) {

	}
}
?>
