<?php
namespace Sy\Form;

class File extends Element implements ValidableElement {
	
	public function __construct() {
		parent::__construct('input');
		$this->setAttribute('type', 'file');
	}

	public function isValid($value) {
		if ($this->isRequired()) {
			if (!isset($value) or $value === '') {
				$this->error = true;
				return false;
			}
		}
		return true;
	}

}
?>
