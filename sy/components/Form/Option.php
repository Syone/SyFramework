<?php
namespace Sy\Form;

class Option extends Element {

	public function __construct() {
		parent::__construct('option');
	}

	public function fill($values) {
		print_r($values);
		$v = is_null($this->getAttribute('value')) ? $this->content : $this->getAttribute('value');
		echo ' v = ' . $v;
		if (is_array($values)) {
			if (in_array($v, $values)) $this->setAttribute('selected', 'selected');
		} else {
			if ($value == $v) $this->setAttribute('selected', 'selected');
		}
	}
}
?>
