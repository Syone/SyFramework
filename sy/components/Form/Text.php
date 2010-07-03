<?php
namespace Sy\Form;

class Text extends Element {

	public function __construct() {
		parent::__construct('input');
		$this->setAttribute('type', 'text');
	}

	public function fill($value) {
		$this->setAttribute('value', $value);
	}

	public function isValid($value) {
		if ($this->isRequired() and $value === '') return false;
		foreach ($this->options['validator'] as $v) {
			$filter = filter_id($v);
			$options = array();
			if (empty($filter) and function_exists($v)) {
				$filter = FILTER_CALLBACK;
				$options['options'] = $v;
			}
			if (!filter_var($value, $filter, $options)) return false;
		}
		return true;
	}
}
?>
