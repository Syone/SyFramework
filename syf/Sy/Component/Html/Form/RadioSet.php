<?php
namespace Sy\Component\Html\Form;

class RadioSet extends FieldContainer {

	private $radios;
	private $name;
	private $id;
	private $validator;
	private $error;
	private $required;
	private $checked;

	public function __construct(array $radios, array $options = array()) {
		parent::__construct();
		$this->radios    = $radios;
		$this->name      = isset($options['name'])      ? $options['name']      : '';
		$this->id        = isset($options['id'])        ? $options['id']        : '';
		$this->validator = isset($options['validator']) ? $options['validator'] : '';
		$this->error     = isset($options['error'])     ? $options['error']     : '';
		$this->required  = isset($options['required'])  ? $options['required']  : '';
		$this->checked   = isset($options['checked'])   ? $options['checked']   : '';
		$this->setTemplateFile(__DIR__ . '/templates/ElementSet.tpl', 'php');
	}

	public function __toString() {
		$id = empty($this->id) ? uniqid() : $this->id;
		$i = 1;
		$data = $this->transformArray($this->radios);
		if ($this->isAssoc($data)) {
			foreach ($data as $value => $label) {
				$radio = $this->addRadioIn($id . '_' . $i++, $value, $label);
				if ($i == 1) $this->addRadioOptions($radio);
			}
		} else {
			foreach ($data as $value) {
				$radio = $this->addRadioIn($id . '_' . $i++, $value, $value);
				if ($i == 1) $this->addRadioOptions($radio);
			}
		}
		return parent::__toString();
	}

	private function addRadioIn($id, $value, $label) {
		$radio = $this->addRadio(
			array(
				'name'  => $this->name,
				'value' => $value,
				'id'    => $id,
			),
			array('label' => $label)
		);
		if ($this->checked === $value) $radio->setAttribute('checked', 'checked');
		return $radio;
	}

	private function addRadioOptions($radio) {
		if (!empty($this->validator)) $radio->setOption('validator', $this->validator);
		if (!empty($this->error))     $radio->setOption('error'    , $this->error);
		if (!empty($this->required))  $radio->setOption('required' , $this->required);
	}

	/**
	 * Transform a 2D array of value/label into a 1D array
	 *
	 * @param array $array
	 * @return array
	 */
	private function transformArray($array) {
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
	private function isAssoc($var) {
		return is_array($var) and array_diff_key($var, array_keys(array_keys($var)));
	}

}