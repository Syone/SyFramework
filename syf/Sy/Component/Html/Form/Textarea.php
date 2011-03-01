<?php
namespace Sy\Component\Html\Form;

class Textarea extends TextElement implements FillableElement {
	
	public function __construct() {
		parent::__construct('textarea');
		$this->setContent('');
	}

	public function fill($value) {
		if (is_array($value)) return;
		$this->setContent($value);
	}

}