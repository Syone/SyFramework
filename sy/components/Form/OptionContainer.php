<?php
namespace Sy\Form;

class OptionContainer extends Container {

	public function addOptGroup($label) {
		$optgroup = new OptionContainer('optgroup');
		$optgroup->setAttribute('label', $label);
		return $this->addElement($optgroup);
	}

	public function addOption($label, $value = NULL) {
		$option = new Option();
		$option->setContent($label);
		if (!is_null($value)) $option->setAttribute('value', $value);
		return $this->addElement($option);
	}

	public function fill($values) {
		foreach ($this->elements as $e) {
			$name = $this->getAttribute('name');
			if (is_null($name)) {
				$e->fill($values);
			}
			else {
				$name = rtrim($name, '[]');
				if (isset($values[$name])) $e->fill($values[$name]);
			}
		}
	}

	public function isValid($values) {
		if (!$this->isRequired()) return true;
		$name = $this->getAttribute('name');
		if (is_null($name)) return false;
		$name = rtrim($name, '[]');
		if (!isset($values[$name])) return false;
		if (is_array($values[$name]) and empty($values[$name])) return false;
		if ($values[$name] === '') return false;
		return true;
	}
}
?>
