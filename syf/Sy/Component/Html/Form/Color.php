<?php
namespace Sy\Component\Html\Form;

class Color extends TextElement implements FillableElement {

	public function __construct() {
		parent::__construct('input');
	}

	public function fill($value) {
		if (is_array($value)) return;
		$this->setAttribute('value', $value);
	}

	public function __toString() {
		$this->setAttribute('type', 'color');
		return parent::__toString();
	}

}