<?php
namespace Sy\Form;

class FieldContainer extends Container {

	protected function addInput($class, $attributes = array(), $options = array()) {
		$class = __NAMESPACE__ . '\\' . $class;
		$input = new $class();
		foreach ($attributes as $name => $value) {
			$input->setAttribute($name, $value);
		}
		$input->setOptions($options);
		return $this->addElement($input);
	}

	public function addText($attributes = array(), $options = array()) {
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
		return $this->addElement($button);
	}

	public function addTextarea($content = '') {
		$textarea = new Textarea();
		$textarea->setContent($content);
		return $this->addElement($textarea);
	}
	
}
?>
