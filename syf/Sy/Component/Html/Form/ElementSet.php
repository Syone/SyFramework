<?php
namespace Sy\Component\Html\Form;

class ElementSet extends FieldContainer {

	public function __construct() {
		parent::__construct();
		$this->setTemplateFile(__DIR__ . '/templates/ElementSet.tpl', 'php');
	}

	/**
	 * Transform a 2D array of value/label into a 1D array
	 *
	 * @param array $array
	 * @return array
	 */
	protected function transformArray($array) {
		$res = array();
		$element = current($array);
		if (is_array($element)) {
			foreach ($array as $e) {
				$tmp = array_values($e);
				if (count($tmp) > 1) {
					$res[$tmp[0]] = $tmp[1];
				} else {
					$res[] = $tmp[0];
				}
			}
		} else {
			$res = $array;
		}
		return $res;
	}

	/**
	 * Check if $var is an associative array or not
	 *
	 * @param array $var
	 * @return bool
	 */
	protected function isAssoc($var) {
		return array_keys($var) !== range(0, count($var) - 1);
	}

}