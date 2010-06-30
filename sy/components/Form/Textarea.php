<?php
namespace Sy\Form;

class Textarea extends Element {
	
	public function __construct() {
		parent::__construct('textarea');
	}

	public function fill($value) {
		$this->setContent($value);
	}
}
?>
