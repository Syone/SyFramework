<?php
namespace Sy\Form;

class FieldContainer extends Container {

	public function addInput($attributes, $options = array()) {
		$input = new Element('input');
		$input->setAttributes($attributes);
		$input->setOptions($options);
		return $this->addElement($input);
	}

	public function addSelect($attributes = array(), $options= array()) {
		$select = new OptionContainer('select');
		$select->setAttributes($attributes);
		$select->setOptions($options);
		return $this->addElement($select);
	}

	public function addButton($label, $attributes = array()) {
		$button = new Element('button');
		$button->setContent($label);
		return $this->addElement($button);
	}

	public function addTextarea($content = '') {
		$textarea = new Element('textarea');
		$textarea->setContent($content);
		return $this->addElement($textarea);
	}
	
}
?>
