<?php
namespace Sy\Form;

class Text extends TextElement {

	public function __construct() {
		parent::__construct('input');
		$this->setAttribute('type', 'text');
	}

	public function fill($value) {
		$this->setAttribute('value', $value);
	}

}
?>
