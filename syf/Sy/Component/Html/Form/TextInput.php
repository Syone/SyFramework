<?php
namespace Sy\Component\Html\Form;

class TextInput extends TextElement {

	private $type;

	public function __construct($type) {
		parent::__construct('input');
		$this->type = $type;
	}

	public function __toString() {
		$this->setAttribute('type', $this->type);
		return parent::__toString();
	}

}