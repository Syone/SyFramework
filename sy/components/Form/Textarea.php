<?php
namespace Sy\Form;

class Textarea extends TextElement {
	
	public function __construct() {
		parent::__construct('textarea');
	}

	public function fill($value) {
		$this->setContent($value);
	}

}
?>
