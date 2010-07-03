<?php
namespace Sy\Form;

class File extends Element {
	
	public function __construct() {
		parent::__construct('input');
		$this->setAttribute('type', 'file');
	}

	public function fill($value) {

	}

	public function isValid($value) {
		return true;
	}
}
?>
