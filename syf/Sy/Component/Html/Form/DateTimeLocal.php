<?php
namespace Sy\Component\Html\Form;

class DateTimeLocal extends TextInput implements FillableElement {

	public function __construct() {
		parent::__construct('datetime-local');
	}

	public function fill($value) {
		if (is_array($value)) return;
		$this->setAttribute('value', $value);
	}

}