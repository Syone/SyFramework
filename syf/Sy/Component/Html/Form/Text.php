<?php
namespace Sy\Component\Html\Form;

class Text extends TextElement implements FillableElement {

	public function __construct() {
		parent::__construct('input');
	}

	/**
	 * Set the element attribute
	 *
	 * @param string $name attribute name
	 * @param string $value attribute value
	 */
	public function setAttribute($name, $value) {
		if (\strtolower($name) === 'value')
			$value = \htmlspecialchars($value);
		parent::setAttribute($name, $value);
	}

	public function fill($value) {
		if (is_array($value)) return;
		$this->setAttribute('value', $value);
	}

	public function __toString() {
		$this->setAttribute('type', 'text');
		return parent::__toString();
	}

}