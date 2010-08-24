<?php
namespace Sy\Form;

class OptionContainer extends Container {

	public function __construct($name = '') {
		parent::__construct($name);
		$this->setTemplateFile(__DIR__ . '/templates/OptionContainer.tpl', 'php');
	}

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
			
			// if optgroup
			if (is_null($name)) {
				$e->fill($values);
			}
			else {
				$e->fill($this->dissolveArrayValue($values, $name));
			}
		}
	}

	public function isValid($values) {
		if (!$this->isRequired()) return true;
		$name = $this->getAttribute('name');
		if (is_null($name)) {
			$this->error = true;
			return false;
		}
		$value = $this->dissolveArrayValue($values, $name);
		if (is_array($value) and empty($value)) {
			$this->error = true;
			return false;
		}
		if ($value === '' or is_null($value)) {
			$this->error = true;
			return false;
		}
		return true;
	}
}
?>
