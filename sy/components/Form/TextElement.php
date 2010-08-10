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
		} else {
			if (empty($value)) return true;
		}
		if (!isset($this->options['validator'])) return true;
		$validators = $this->options['validator'];
		if (!is_array($validators)) $validators = array($validators);
		foreach ($validators as $v) {
			$options = array();
			$filter = FILTER_CALLBACK;
			$validator = new Validator();
			if (method_exists($validator, $v)) $options['options'] = array($validator, $v);
			if (function_exists($v)) $options['options'] = $v;
			if (empty($options)) continue;
			if (!filter_var($value, $filter, $options)) return false;
		}
		return true;
	}
}
?>
