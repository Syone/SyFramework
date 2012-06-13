<?php
namespace Sy\Component\Html\Form;

class Container extends Element implements FillableElement, ValidableElement {

	public function __construct($name = '') {
		parent::__construct($name);
	}

	/**
	 * Get contained elements
	 *
	 * @return array Element array
	 */
	public function getElements() {
		$elements = $this->getContent();
		return array_filter($elements, function ($e) {
			return $e instanceof Element;
		});
	}

	/**
	 * Fill all the elements contained
	 *
	 * @param array $values
	 */
	public function fill($values) {
		foreach ($this->getElements() as $e) {
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

	/**
	 * Validate the container
	 *
	 * @param array $values
	 * @return boolean
	 */
	public function isValid($values) {
		$valid = true;
		foreach ($this->getElements() as $e) {
			if (!$e instanceof ValidableElement) continue;
			if ($e instanceof Container) {
				if (!$e->isValid($values)) $valid = false;
			} elseif ($e instanceof File) {
				$name = $e->getAttribute('name');
				$e->isValid($name);
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

		if ($arrayPath === '') return null;

		$keys = explode('[', $arrayPath);

		if (empty($keys)) return null;

		$func = function($val) {
			return rtrim($val, ']');
		};

		$keys = array_map($func, $keys);
		$keys = array_filter($keys);

		$path = '';
		foreach ($keys as $key) {
			$path .= "['$key']";
		}
		$res = '$value' . $path;
		$ret = eval("if (isset($res)) return $res; else return null;");
		return $ret;
	}

}