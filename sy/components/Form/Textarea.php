<?php
namespace Sy\Form;

class Textarea extends TextElement implements FillableElement {
	
	public function __construct() {
		parent::__construct('textarea');
		$this->setContent('');
	}

	public function fill($value) {
		$this->setContent($value);
	}

}
?>
