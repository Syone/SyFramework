<?php
namespace Sy\Component\Html\Form;

class TextFillableInput extends TextInput implements FillableElement {

	public function fill($value) {
		if (is_array($value)) return;
		$this->setAttribute('value', $value);
	}

}