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
	protected $options;

	public function __construct(array $inputs, array $options = array()) {
		parent::__construct();
		$this->inputs    = $inputs;
		$this->name      = isset($options['name'])      ? $options['name']      : '';
		$this->id        = isset($options['id'])        ? $options['id']        : '';
		$this->validator = isset($options['validator']) ? $options['validator'] : '';
		$this->error     = isset($options['error'])     ? $options['error']     : '';
		$this->required  = isset($options['required'])  ? $options['required']  : '';
		$this->checked   = isset($options['checked'])   ? $options['checked']   : '';
		$this->options = array();
		if (isset($options['label-class']))    $this->options['label-class']    = $options['label-class'];
		if (isset($options['label-position'])) $this->options['label-position'] = $options['label-position'];
		if (isset($options['error-position'])) $this->options['error-position'] = $options['error-position'];
		$this->setTemplateFile(__DIR__ . '/templates/InputSet.tpl', 'php');
		$this->init();
	}

	protected function init() {
		$id = empty($this->id) ? uniqid() : $this->id;
		$i = 0;
		$data = $this->transformArray($this->inputs);
		if (array_values($data) !== $data) { // is assoc
			foreach ($data as $value => $label) {
				$input = $this->addInputIn($id . '_' . ++$i, $value, $label, $this->options);
				if ($i == 1) $this->addInputOptions($input);
			}
		} else {
			foreach ($data as $value) {
				$input = $this->addInputIn($id . '_' . ++$i, $value, $value, $this->options);
				if ($i == 1) $this->addInputOptions($input);
			}
		}
	}

	abstract protected function addInputIn($id, $value, $label, $options = array());

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

}