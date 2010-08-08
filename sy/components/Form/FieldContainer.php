<?php
namespace Sy\Form;

class FieldContainer extends Container {

	/**
	 * Add a div container
	 *
	 * @param array $attributes div attributes
	 * @return FieldContainer
	 */
	public function addDiv($attributes = array()) {
		return $this->addElement(new FieldContainer('div'));
	}

	/**
	 * Add a fieldset element
	 *
	 * @param string $legend the fieldset legend
	 * @return Fieldset
	 */
	public function addFieldset($legend = NULL) {
		return $this->addElement(new Fieldset($legend));
	}

	/**
	 * Add a button element
	 *
	 * @param string $label button label
	 * @param array $attributes button attributes
	 * @return Button
	 */
	public function addButton($label, $attributes = array()) {
		$button = new Button();
		$button->setContent($label);
		$button->setAttributes($attributes);
		return $this->addElement($button);
	}

	/**
	 * Add a checkbox element
	 *
	 * @param array $attributes checkbox attributes
	 * @param array $options checkbox options
	 * @return Checkbox
	 */
	public function addCheckbox($attributes = array(), $options = array()) {
		return $this->addInput('Checkbox', $attributes, $options);
	}

	/**
	 * Add a file element
	 *
	 * @param array $attributes file attributes
	 * @param array $options file options
	 * @return File
	 */
	public function addFile($attributes = array(), $options = array()) {
		return $this->addInput('File', $attributes, $options);
	}

	/**
	 * Add a hidden element
	 *
	 * @param array $attributes hidden attributes
	 * @param array $options hidden options
	 * @return Hidden
	 */
	public function addHidden($attributes = array(), $options = array()) {
		return $this->addInput('Hidden', $attributes, $options);
	}

	/**
	 * Add a image element
	 *
	 * @param array $attributes image attributes
	 * @param array $options image options
	 * @return Image
	 */
	public function addImage($attributes = array(), $options = array()) {
		return $this->addInput('Image', $attributes, $options);
	}

	/**
	 * Add a password element
	 *
	 * @param array $attributes password attributes
	 * @param array $options password options
	 * @return Password
	 */
	public function addPassword($attributes = array(), $options = array()) {
		return $this->addInput('Password', $attributes, $options);
	}

	/**
	 * Add a radio element
	 *
	 * @param array $attributes radio attributes
	 * @param array $options radio options
	 * @return Radio
	 */
	public function addRadio($attributes = array(), $options = array()) {
		return $this->addInput('Radio', $attributes, $options);
	}

	/**
	 * Add a reset element
	 *
	 * @param array $attributes reset attributes
	 * @param array $options reset options
	 * @return Reset
	 */
	public function addReset($attributes = array(), $options = array()) {
		return $this->addInput('Reset', $attributes, $options);
	}

	/**
	 * Add a select element
	 *
	 * @param array $attributes select attributes
	 * @param array $options select options
	 * @return OptionContainer
	 */
	public function addSelect($attributes = array(), $options= array()) {
		$select = new OptionContainer('select');
		$select->setAttributes($attributes);
		$select->setOptions($options);
		return $this->addElement($select);
	}

	/**
	 * Add a submit element
	 *
	 * @param array $attributes submit attributes
	 * @param array $options submit options
	 * @return Submit
	 */
	public function addSubmit($attributes = array(), $options = array()) {
		return $this->addInput('Submit', $attributes, $options);
	}

	/**
	 * Add a text element
	 *
	 * @param array $attributes text attributes
	 * @param array $options text options
	 * @return Text
	 */
	public function addText($attributes = array(), $options = array()) {
		return $this->addInput('Text', $attributes, $options);
	}

	/**
	 * Add a textarea element
	 *
	 * @param array $attributes textarea attributes
	 * @param array $options textarea options
	 * @return Textarea
	 */
	public function addTextarea($attributes = array(), $options= array()) {
		$textarea = new Textarea();
		$textarea->setAttributes($attributes);
		$textarea->setOptions($options);
		return $this->addElement($textarea);
	}

	/**
	 * Add a input element
	 *
	 * @param array $attributes input attributes
	 * @param array $options input options
	 * @return Element
	 */
	protected function addInput($class, $attributes = array(), $options = array()) {
		$class = __NAMESPACE__ . '\\' . $class;
		$input = new $class();
		$input->setAttributes($attributes);
		$input->setOptions($options);
		return $this->addElement($input);
	}
	
}
?>
