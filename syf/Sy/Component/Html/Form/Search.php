<?php
namespace Sy\Component\Html\Form;

class Search extends TextInput implements FillableElement {

	public function __construct() {
		parent::__construct('search');
	}

	public function fill($value) {
		if (is_array($value)) return;
		$this->setAttribute('value', $value);
	}

}