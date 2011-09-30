<?php
namespace Sy\Component\Html\Form;

class Url extends TextInput implements FillableElement {

	public function __construct() {
		parent::__construct('url');
	}

	public function fill($value) {
		if (is_array($value)) return;
		$this->setAttribute('value', $value);
	}

}