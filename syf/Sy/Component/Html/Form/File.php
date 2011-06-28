<?php
namespace Sy\Component\Html\Form;

class File extends Input implements ValidableElement {

	public function __construct() {
		parent::__construct('file');
	}

	public function isValid($value) {
		if ($this->isRequired()) {
			if (!isset($value) or $value === '') {
				$this->setError(true);
				return false;
			}
		}
		return true;
	}

}