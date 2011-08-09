<?php
namespace Sy\Component\Html\Form;

class Search extends TextElement implements FillableElement {

	public function __construct() {
		parent::__construct('input');
	}

	public function fill($value) {
		if (is_array($value)) return;
		$this->setAttribute('value', $value);
	}

	public function __toString() {
		$this->setAttribute('type', 'search');
		return parent::__toString();
	}

}