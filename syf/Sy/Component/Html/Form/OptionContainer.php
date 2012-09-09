<?php
namespace Sy\Component\Html\Form;

class OptionContainer extends Container {

	public function __construct($name = '') {
		parent::__construct($name);
		$this->setTemplateFile(__DIR__ . '/templates/OptionContainer.tpl', 'php');
	}

	/**
	 * Add an optgroup element
	 *
	 * @param string $label optgroup label attribute
	 * @return OptionContainer
	 */
	public function addOptGroup($label) {
		$optgroup = new OptionContainer('optgroup');
		$optgroup->setAttribute('label', $label);
		return $this->addElement($optgroup);
	}

	/**
	 * Add an option element
	 *
	 * @param string $label option content
	 * @param string $value option value
	 * @return Option
	 */
	public function addOption($label, $value = null) {
		$option = new Option();
		$option->addText($label);
		if (!is_null($value)) {
			$option->setAttribute('value', $value);
		}
		return $this->addElement($option);
	}

	/**
	 * Add multiple options
	 *
	 * @param mixed $options
	 */
	public function addOptions($options) {
		if (is_array($options)) {
			foreach ($options as $value => $label) {
				$this->addOption($label, $value);
			}
		} else {
			$values = func_get_args();
			foreach ($values as $value) {
				$this->addOption($value);
			}
		}
	}

	/**
	 * Fill the select
	 *
	 * @param mixed $values
	 */
	public function fill($values) {
		foreach ($this->getElements() as $element) {
			$name = $this->getAttribute('name');

			// if optgroup
			if (is_null($name)) {
				$element->fill($values);
			}
			else {
				$element->fill($this->dissolveArrayValue($values, $name));
			}
		}
	}

	/**
	 * Return if the element is valid
	 *
	 * @param mixed $values
	 * @return bool
	 */
	public function isValid($values) {
		if (!$this->isRequired()) return true;
		$name = $this->getAttribute('name');
		if (is_null($name)) {
			return false;
		}
		$value = $this->dissolveArrayValue($values, $name);
		if (is_array($value) and empty($value)) {
			return false;
		}
		if ($value === '' or is_null($value)) {
			return false;
		}
		return true;
	}

	public function __toString() {
		// Add option elements
		if (!is_null($this->getOption('options')))
			$this->addOptions($this->getOption('options'));

		// Check selected option elements
		if (!is_null($this->getOption('selected')))
			$this->checkSelectedOption();

		return parent::__toString();
	}

	private function checkSelectedOption() {
		$values = $this->getOption('selected');
		foreach ($this->getElements() as $element) {
			$element->fill($values);
		}
	}

}