<?php
namespace Sy\Component\Html\Form;

class FieldContainer extends Container {

	public function __construct($name = '') {
		parent::__construct($name);
		$this->setTemplateFile(__DIR__ . '/templates/FieldContainer.tpl', 'php');
	}

	/**
	 * Add a div container
	 *
	 * @param array $attributes div attributes
	 * @return FieldContainer
	 */
	public function addDiv(array $attributes = array()) {
		$div = $this->addElement(new FieldContainer('div'));
		$div->setAttributes($attributes);
		return $div;
	}

	/**
	 * Add a fieldset element
	 *
	 * @param string $label the fieldset legend
	 * @param array $attributes fieldset attributes
	 * @return FieldContainer
	 */
	public function addFieldset($label = null, array $attributes = array()) {
		$fieldset = new FieldContainer('fieldset');
		$fieldset->setAttributes($attributes);
		if (!is_null($label)) {
			$legend = new Element('legend');
			$legend->addText($label);
			$fieldset->addElement($legend);
		}
		return $this->addElement($fieldset);
	}

	/**
	 * Add a label element
	 *
	 * @param string $label the label content
	 * @param array $attributes label attributes
	 * @return Element
	 */
	public function addLabel($label, array $attributes = array()) {
		$element = new Element('label');
		$element->addText($label);
		$element->setAttributes($attributes);
		return $this->addElement($element);
	}

	/**
	 * Add a button element
	 *
	 * @param string $label button label
	 * @param array $attributes button attributes
	 * @return Element
	 */
	public function addButton($label, array $attributes = array()) {
		$element = new Element('button');
		$element->addText($label);
		$element->setAttributes($attributes);
		return $this->addElement($element);
	}

	/**
	 * Add a checkbox element
	 *
	 * @param array $attributes checkbox attributes
	 * @param array $options checkbox options
	 * @return Checkbox
	 */
	public function addCheckbox(array $attributes = array(), array $options = array()) {
		return $this->addInput('Checkbox', $attributes, $options);
	}

	/**
	 * Add a set of checkbox element
	 *
	 * @param array $checkboxes checkbox set elements data
	 * @param array $options checkbox set options
	 * @return CheckboxSet
	 */
	public function addCheckboxSet(array $checkboxes, array $options = array()) {
		return $this->addElement(new CheckboxSet($checkboxes, $options));
	}

	/**
	 * Add a color element.
	 * This input type will allow you to select a color from a color picker.
	 *
	 * @param array $attributes
	 * @param array $options
	 * @return TextFillableInput
	 */
	public function addColor(array $attributes = array(), array $options = array()) {
		$element = new TextFillableInput('color');
		$element->setAttributes($attributes);
		$element->setOptions($options);
		return $this->addElement($element);
	}

	/**
	 * Add a date element. Selects date, month and year.
	 *
	 * @param array $attributes
	 * @param array $options
	 * @return TextFillableInput
	 */
	public function addDate(array $attributes = array(), array $options = array()) {
		$element = new TextFillableInput('date');
		$element->setAttributes($attributes);
		$element->setOptions($options);
		return $this->addElement($element);
	}

	/**
	 * Add a month element. Selects month and year.
	 *
	 * @param array $attributes
	 * @param array $options
	 * @return TextFillableInput
	 */
	public function addMonth(array $attributes = array(), array $options = array()) {
		$element = new TextFillableInput('month');
		$element->setAttributes($attributes);
		$element->setOptions($options);
		return $this->addElement($element);
	}

	/**
	 * Add a week element. Selects week and year.
	 *
	 * @param array $attributes
	 * @param array $options
	 * @return TextFillableInput
	 */
	public function addWeek(array $attributes = array(), array $options = array()) {
		$element = new TextFillableInput('week');
		$element->setAttributes($attributes);
		$element->setOptions($options);
		return $this->addElement($element);
	}

	/**
	 * Add a time element. Selects time (hour and minute).
	 *
	 * @param array $attributes
	 * @param array $options
	 * @return TextFillableInput
	 */
	public function addTime(array $attributes = array(), array $options = array()) {
		$element = new TextFillableInput('time');
		$element->setAttributes($attributes);
		$element->setOptions($options);
		return $this->addElement($element);
	}

	/**
	 * Add a datetime element. Selects time, date, month and year (UTC time).
	 *
	 * @param array $attributes
	 * @param array $options
	 * @return TextFillableInput
	 */
	public function addDateTime(array $attributes = array(), array $options = array()) {
		$element = new TextFillableInput('datetime');
		$element->setAttributes($attributes);
		$element->setOptions($options);
		return $this->addElement($element);
	}

	/**
	 * Add a datetime-local element. Selects time, date, month and year (local time).
	 *
	 * @param array $attributes
	 * @param array $options
	 * @return TextFillableInput
	 */
	public function addDateTimeLocal(array $attributes = array(), array $options = array()) {
		$element = new TextFillableInput('datetime-local');
		$element->setAttributes($attributes);
		$element->setOptions($options);
		return $this->addElement($element);
	}

	/**
	 * Add a email element.
	 * The email input type is used for input fields that should contain an e-mail address.
	 *
	 * @param array $attributes
	 * @param array $options
	 * @return TextFillableInput
	 */
	public function addEmail(array $attributes = array(), array $options = array()) {
		$element = new TextFillableInput('email');
		$element->setAttributes($attributes);
		$element->setOptions($options);
		$element->addValidator('Sy\\Component\\Html\\Form\\email');
		return $this->addElement($element);
	}

	/**
	 * Add a file element
	 *
	 * @param array $attributes file attributes
	 * @param array $options file options
	 * @return File
	 */
	public function addFile(array $attributes = array(), array $options = array()) {
		return $this->addInput('File', $attributes, $options);
	}

	/**
	 * Add a hidden element
	 *
	 * @param array $attributes hidden attributes
	 * @param array $options hidden options
	 * @return Hidden
	 */
	public function addHidden(array $attributes = array(), array $options = array()) {
		return $this->addInput('Hidden', $attributes, $options);
	}

	/**
	 * Add a image element
	 *
	 * @param array $attributes image attributes
	 * @param array $options image options
	 * @return Input
	 */
	public function addImage(array $attributes = array(), array $options = array()) {
		$element = new Input('image');
		$element->setAttributes($attributes);
		$element->setOptions($options);
		return $this->addElement($element);
	}

	/**
	 * Add a number element
	 *
	 * @param array $attributes text attributes
	 * @param array $options text options
	 * @return TextFillableInput
	 */
	public function addNumber(array $attributes = array(), array $options = array()) {
		$element = new TextFillableInput('number');
		$element->setAttributes($attributes);
		$element->setOptions($options);
		$element->addValidator('Sy\\Component\\Html\\Form\\int');
		return $this->addElement($element);
	}

	/**
	 * Add a password element
	 *
	 * @param array $attributes password attributes
	 * @param array $options password options
	 * @return TextInput
	 */
	public function addPassword(array $attributes = array(), array $options = array()) {
		$element = new TextInput('password');
		$element->setAttributes($attributes);
		$element->setOptions($options);
		return $this->addElement($element);
	}

	/**
	 * Add a radio element
	 *
	 * @param array $attributes radio attributes
	 * @param array $options radio options
	 * @return Radio
	 */
	public function addRadio(array $attributes = array(), array $options = array()) {
		return $this->addInput('Radio', $attributes, $options);
	}

	/**
	 * Add a set of radio element
	 *
	 * @param array $radios radio set elements data
	 * @param array $options radio set options
	 * @return RadioSet
	 */
	public function addRadioSet(array $radios, array $options = array()) {
		return $this->addElement(new RadioSet($radios, $options));
	}

	/**
	 * Add a range element.
	 * The range input type is used for input fields that should contain a value from a range of numbers.
	 *
	 * @param array $attributes
	 * @param array $options
	 * @return Range
	 */
	public function addRange(array $attributes = array(), array $options = array()) {
		$element = new TextFillableInput('range');
		$element->setAttributes($attributes);
		$element->setOptions($options);
		return $this->addElement($element);
	}

	/**
	 * Add a reset element
	 *
	 * @param array $attributes reset attributes
	 * @param array $options reset options
	 * @return Input
	 */
	public function addReset(array $attributes = array(), array $options = array()) {
		$element = new Input('reset');
		$element->setAttributes($attributes);
		$element->setOptions($options);
		return $this->addElement($element);
	}

	/**
	 * Add a select element
	 *
	 * @param array $attributes select attributes
	 * @param array $options select options
	 * @return OptionContainer
	 */
	public function addSelect(array $attributes = array(), array $options= array()) {
		$select = new OptionContainer('select');
		$select->setAttributes($attributes);
		$select->setOptions($options);
		return $this->addElement($select);
	}

	/**
	 * Add a search element.
	 * The search input type is used for search fields, like a site search, or Google search.
	 *
	 * @param array $attributes
	 * @param array $options
	 * @return Search
	 */
	public function addSearch(array $attributes = array(), array $options = array()) {
		$element = new TextFillableInput('search');
		$element->setAttributes($attributes);
		$element->setOptions($options);
		return $this->addElement($element);
	}

	/**
	 * Add a submit element
	 *
	 * @param array $attributes submit attributes
	 * @param array $options submit options
	 * @return Input
	 */
	public function addSubmit(array $attributes = array(), array $options = array()) {
		$element = new Input('submit');
		$element->setAttributes($attributes);
		$element->setOptions($options);
		return $this->addElement($element);
	}

	/**
	 * Add a tel element.
	 * The tel input type is used for input fields that should contain a telephone number.
	 *
	 * @param array $attributes
	 * @param array $options
	 * @return Tel
	 */
	public function addTel(array $attributes = array(), array $options = array()) {
		$element = new TextFillableInput('tel');
		$element->setAttributes($attributes);
		$element->setOptions($options);
		return $this->addElement($element);
	}

	/**
	 * Add a text element
	 *
	 * @param array $attributes text attributes
	 * @param array $options text options
	 * @return TextFillableInput
	 */
	public function addInputText(array $attributes = array(), array $options = array()) {
		$element = new TextFillableInput('text');
		$element->setAttributes($attributes);
		$element->setOptions($options);
		return $this->addElement($element);
	}

	/**
	 * Add a textarea element
	 *
	 * @param array $attributes textarea attributes
	 * @param array $options textarea options
	 * @return Textarea
	 */
	public function addTextarea(array $attributes = array(), array $options= array()) {
		return $this->addInput('Textarea', $attributes, $options);
	}

	/**
	 * Add an url element.
	 * The url input type is used for input fields that should contain a URL address.
	 *
	 * @param array $attributes
	 * @param array $options
	 * @return Url
	 */
	public function addUrl(array $attributes = array(), array $options= array()) {
		$element = new TextFillableInput('url');
		$element->setAttributes($attributes);
		$element->setOptions($options);
		return $this->addElement($element);
	}

	/**
	 * Add a input element
	 *
	 * @param array $attributes input attributes
	 * @param array $options input options
	 * @return Element
	 */
	protected function addInput($class, array $attributes = array(), array $options = array()) {
		$class = __NAMESPACE__ . '\\' . $class;
		$input = new $class();
		$input->setAttributes($attributes);
		$input->setOptions($options);
		return $this->addElement($input);
	}

}