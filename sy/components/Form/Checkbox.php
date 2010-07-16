<?php
namespace Sy\Form;

class Checkbox extends Element implements FillableElement {
	
	public function __construct() {
		parent::__construct('input');
		$this->setAttribute('type', 'checkbox');
	}

	public function fill($value) {
		if ($this->getAttribute('value') == $value)
			$this->setAttribute('checked', 'checked');
	}

}
?>
