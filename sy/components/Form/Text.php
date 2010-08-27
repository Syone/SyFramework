<?php
namespace Sy\Form;

class Text extends TextElement implements FillableElement {

	public function __construct() {
		parent::__construct('input');
		$this->setAttribute('type', 'text');
	}

	public function fill($value) {
		if (is_array($value)) return;
		$this->setAttribute('value', $value);
	}

}