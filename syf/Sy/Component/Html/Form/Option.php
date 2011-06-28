<?php
namespace Sy\Component\Html\Form;

class Option extends Element implements FillableElement {

	public function __construct() {
		parent::__construct('option');
	}

	public function fill($values) {
		$v = is_null($this->getAttribute('value')) ? $this->getContent() : $this->getAttribute('value');
		if (is_array($values)) {
			if (in_array($v, $values, true)) $this->setAttribute('selected', 'selected');
		} else {
			if ($values === $v) $this->setAttribute('selected', 'selected');
		}
	}

}