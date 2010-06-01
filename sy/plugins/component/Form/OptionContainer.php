<?php
namespace Sy\Form;

class OptionContainer extends Container {

	public function addOptGroup($label) {
		$optgroup = new OptionContainer('optgroup');
		$optgroup->setAttribute('label', $label);
		return $this->addElement($optgroup);
	}

	public function addOption($label, $value = '') {
		$option = new Element('option');
		$option->setContent($label);
		if (!empty($value)) $option->setAttribute('value', $value);
		return $this->addElement($option);
	}
}
?>
