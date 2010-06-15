<?php
namespace Sy\Form;

class FieldContainer extends Container {

	public function addButton($label, $attributes = array()) {
		$button = new Button();
		$button->setContent($label);
		$button->setAttributes($attributes);
		return $this->addElement($button);
	}

	public function addCheckbox($attributes = array(), $options = array()) {
		return $this->addInput('Checkbox', $attributes, $options);
	}

	public function addFile($attributes = array(), $options = array()) {
		return $this->addInput('File', $attributes, $options);
	}

	public function addHidden($attributes = array(), $options = array()) {
		return $this->addInput('Hidden', $attributes, $options);
	}

	public function addImage($attributes = array(), $options = array()) {
		return $this->addInput('Image', $attributes, $options);
	}

	public function addPassword($attributes = array(), $options = array()) {
		return $this->addInput('Text', $attributes, $options);
	}

	public function addRadio($attributes = array(), $options = array()) {
		return $this->addInput('Radio', $attributes, $options);
	}

	public function addReset($attributes = array(), $options = array()) {
		return $this->addInput('Reset', $attributes, $options);
	}

	public function addSelect($attributes = array(), $options= array()) {
		$select = new OptionContainer('select');
		$select->setAttributes($attributes);
		$select->setOptions($options);
		return $this->addElement($select);
	}

	public function addSubmit($attributes = array(), $options = array()) {
		return $this->addInput('Submit', $attributes, $options);
	}

	public function addText($attributes = array(), $options = array()) {
		return $this->addInput('Text', $attributes, $options);
	}

	public function addTextarea($attributes = array(), $options= array()) {
		$textarea = new Textarea();
		$textarea->setAttributes($attributes);
		$textarea->setOptions($options);
		return $this->addElement($textarea);
	}

	protected function addInput($class, $attributes = array(), $options = array()) {
		$class = __NAMESPACE__ . '\\' . $class;
		$input = new $class();
		$input->setAttributes($attributes);
		$input->setOptions($options);
		return $this->addElement($input);
	}
	
}
?>
