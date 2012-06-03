<?php
namespace Sy\Component\Html\Form;

abstract class InputSet extends FieldContainer {

	protected $inputs;
	protected $name;
	protected $id;
	protected $validator;
	protected $error;
	protected $required;
	protected $checked;

	public function __construct(array $inputs, array $options = array()) {
		parent::__construct();
		$this->inputs    = $inputs;
		$this->name      = isset($options['name'])      ? $options['name']      : '';
		$this->id        = isset($options['id'])        ? $options['id']        : '';
		$this->validator = isset($options['validator']) ? $options['validator'] : '';
		$this->error     = isset($options['error'])     ? $options['error']     : '';
		$this->required  = isset($options['required'])  ? $options['required']  : '';
		$this->checked   = isset($options['checked'])   ? $options['checked']   : '';
		$this->setTemplateFile(__DIR__ . '/templates/InputSet.tpl', 'php');
		$this->init();
	}

	protected function init() {
		$id = empty($this->id) ? uniqid() : $this->id;
		$i = 1;
		$data = $this->transformArray($this->inputs);
		if ($this->isAssoc($data)) {
			foreach ($data as $value => $label) {
				$input = $this->addInputIn($id . '_' . $i++, $value, $label);
				if ($i == 2) $this->addInputOptions($input);
			}
		} else {
			foreach ($data as $value) {
				$input = $this->addInputIn($id . '_' . $i++, $value, $value);
				if ($i == 2) $this->addInputOptions($input);
			}
		}
	}

	abstract protected function addInputIn($id, $value, $label);

	protected function addInputOptions(Input $input) {
		if (!empty($this->validator)) $input->setOption('validator', $this->validator);
		if (!empty($this->error))     $input->setOption('error'    , $this->error);
		if (!empty($this->required))  $input->setOption('required' , $this->required);
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