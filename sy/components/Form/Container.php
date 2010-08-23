<?php
namespace Sy\Form;

class Container extends Element implements FillableElement, ValidableElement {
	
	protected $elements;

	public function __construct($name = '') {
		parent::__construct($name);
		$this->setTemplateFile(__DIR__ . '/templates/Container.tpl', 'php');
		$this->elements = array();
	}

	/**
	 * Add an element
	 *
	 * @param Element $element
	 * @return Element
	 */
	public function addElement($element) {
		$this->elements[] = $element;
		return $element;
	}

	public function fill($values) {
		foreach ($this->elements as $e) {
			if (!$e instanceof FillableElement) continue;
			if ($e instanceof Container) {
				$e->fill($values);
			} else {
				$name = $e->getAttribute('name');
				if (is_null($name)) continue;
				$e->fill($this->dissolveArrayValue($values, $name));
			}
		}
	}

	public function isValid($values) {
		$valid = true;
		foreach ($this->elements as $e) {
			if (!$e instanceof ValidableElement) continue;
			if ($e instanceof Container) {
				if (!$e->isValid($values)) $valid = false;
			} else {
				$name = $e->getAttribute('name');
				if (is_null($name)) continue;
				if (!$e->isValid($this->dissolveArrayValue($values, $name))) $valid = false;
			}
		}
		return $valid;
	}

	/**
	 * Extract the value by walking the array using given array path.
	 *
	 * Given an array path such as foo[bar][baz], returns the value of the last
	 * element (in this case, 'baz').
	 *
	 * @param  array $value Array to walk
	 * @param  string $arrayPath Array notation path of the part to extract
	 * @return mixed
	 */
	protected function dissolveArrayValue($value, $arrayPath) {
		$realValue = $value;

		// As long as we have more levels
		while ($arrayPos = strpos($arrayPath, '[')) {
			// Get the next key in the path
			$arrayKey = trim(substr($arrayPath, 0, $arrayPos), ']');

			// Set the potentially final value or the next search point in the array
			if (isset($value[$arrayKey])) {
				$value = $value[$arrayKey];
			}

			// Set the next search point in the path
			$arrayPath = trim(substr($arrayPath, $arrayPos + 1), ']');
		}

		if (isset($value[$arrayPath])) {
			$value = $value[$arrayPath];
		}

		if ($value == $realValue) return NULL;
		
		return $value;
	}

	public function __toString() {
		if ($this->getTemplateType() == 'php')
			$this->setVar('ELEMENTS', $this->elements);
		return parent::__toString();
	}
}
?>
