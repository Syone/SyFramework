<?php
namespace Sy\Form;

class OptionContainer extends Container {

	public function __construct($name = '') {
		parent::__construct($name);
		$this->setTemplateFile(__DIR__ . '/templates/OptionContainer.tpl', 'php');
	}

	/**
	 * Add an optgroup element
	 *
	 * @param string $label optgroup label attribute
	 * @return Element
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
	 * @return Element
	 */
	public function addOption($label, $value = NULL) {
		$option = new Option();
		$option->setContent($label);
		if (!is_null($value)) $option->setAttribute('value', $value);
		return $this->addElement($option);
	}

	/**
	 * Add multiple options
	 *
	 * @param array $options
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
	 * @param array $values
	 */
	public function fill($values) {
		foreach ($this->getElements() as $e) {
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

	/**
	 * Return if the element is valid
	 *
	 * @param array $values
	 * @return bool
	 */
	public function isValid($values) {
		if (!$this->isRequired()) return true;
		$name = $this->getAttribute('name');
		if (is_null($name)) {
			$this->setError(true);
			return false;
		}
		$value = $this->dissolveArrayValue($values, $name);
		if (is_array($value) and empty($value)) {
			$this->setError(true);
			return false;
		}
		if ($value === '' or is_null($value)) {
			$this->setError(true);
			return false;
		}
		return true;
	}

}