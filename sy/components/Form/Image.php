<?php
namespace Sy\Form;

class Image extends Element {
	
	public function __construct() {
		parent::__construct('input');
		$this->setAttribute('type', 'image');
	}

	public function fill($value) {

	}
}
?>
