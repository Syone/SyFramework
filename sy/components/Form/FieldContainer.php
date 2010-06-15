<?php
namespace Sy\Form;

class FieldContainer extends Container {

	protected function addInput($class, $attributes = array(), $options = array()) {
		$class = __NAMESPACE__ . '\\' . $class;
		$input = new $class();
		$input->setAttributes($attributes);
		$input->setOptions($options);
		return $this->addElement($input);
	}

	public function addText($attributes = array(), $options = array()) {
		$this->addInput('Text', $attributes, $options);
	}

	public function addPassword($attributes = array(), $options = array()) {
		$this->addInput('Text', $attributes, $options);
	}

	public function addRadio($attributes = array(), $options = array()) {
		$this->addInput('Radio', $attributes, $options);
	}

	public function addCheckbox($attributes = array(), $options = array()) {
		$this->addInput('Checkbox', $attributes, $options);
	}

	public function addSelect($attributes = array(), $options= array()) {
		$select = new OptionContainer('select');
		$select->setAttributes($attributes);
		$select->setOptions($options);
		return $this->addElement($select);
	}

	public function addButton($label, $attributes = array()) {
		$button = new Button();
		$button->setContent($label);
		$button->setAttributes($attributes);
		return $this->addElement($button);
	}

	public function addTextarea($attributes = array(), $options= array()) {
		$textarea = new Textarea();
		$textarea->setAttributes($attributes);
		$textarea->setOptions($options);
		return $this->addElement($textarea);
	}
	
}
?>
