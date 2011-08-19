<?php
namespace Sy\Component\Html\Form;

class RadioSet extends ElementSet {

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
		$this->init();
	}

	private function init() {
		$id = empty($this->id) ? uniqid() : $this->id;
		$i = 1;
		$data = $this->transformArray($this->radios);
		if ($this->isAssoc($data)) {
			foreach ($data as $value => $label) {
				$radio = $this->addRadioIn($id . '_' . $i++, $value, $label);
				if ($i == 2) $this->addRadioOptions($radio);
			}
		} else {
			foreach ($data as $value) {
				$radio = $this->addRadioIn($id . '_' . $i++, $value, $value);
				if ($i == 2) $this->addRadioOptions($radio);
			}
		}
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

	private function addRadioOptions(Radio $radio) {
		if (!empty($this->validator)) $radio->setOption('validator', $this->validator);
		if (!empty($this->error))     $radio->setOption('error'    , $this->error);
		if (!empty($this->required))  $radio->setOption('required' , $this->required);
	}

}