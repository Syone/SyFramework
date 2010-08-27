<?php
namespace Sy\Form;

require_once __DIR__ . '/Validator.php';

class TextElement extends Element implements ValidableElement {

	public function isValid($value) {
		$valid = $this->validate($value);
		if (!$valid) $this->error = true;
		return $valid;
	}

	protected function validate($value) {
		if ($this->isRequired()) {
			if (!isset($value) or $value === '') return false;
			if (is_array($value)) {
				$value = array_filter($value);
				if (empty($value)) return false;
			}
		} else {
			if (is_array($value)) $value = array_filter($value);
			if (empty($value)) return true;
		}
		if (!isset($this->options['validator'])) return true;
		$validators = $this->options['validator'];
		if (!is_array($validators)) $validators = array($validators);
		foreach ($validators as $v) {
			$options = array();
			$filter = FILTER_CALLBACK;
			if (is_callable($v)) $options['options'] = $v;
			if (empty($options)) continue;
			if (!filter_var($value, $filter, $options)) return false;
		}
		return true;
	}
}