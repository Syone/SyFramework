<?php
namespace Sy\Form;

class OptionContainer extends Container {

	public function addOptGroup($label) {
		$optgroup = new OptionContainer('optgroup');
		$optgroup->setAttribute('label', $label);
		return $this->addElement($optgroup);
	}

	public function addOption($label, $value = '') {
		$option = new Option();
		$option->setContent($label);
		if (!empty($value)) $option->setAttribute('value', $value);
		return $this->addElement($option);
	}

	public function fill($values) {
		foreach ($this->elements as $e) {
			if (isset($this->attributes['name'])) {
				$name = rtrim($this->attributes['name'], '[]');
				if (isset($values[$name])) $e->fill($values[$name]);
			}
			else {
				$e->fill($values);
			}
		}
	}
}
?>
