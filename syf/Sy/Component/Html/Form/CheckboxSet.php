<?php
namespace Sy\Component\Html\Form;

class CheckboxSet extends InputSet {

	protected function addInputIn($id, $value, $label, $options = array()) {
		$checkbox = $this->addCheckbox(
			array(
				'name'  => $this->name,
				'value' => $value,
				'id'    => $id,
			),
			array('label' => $label)
		);
		if (!empty($options)) $checkbox->setOptions($options);
		$array = is_array($this->checked) ? $this->checked : array($this->checked);
		if (in_array($value, $array, true)) $checkbox->setAttribute('checked', 'checked');
		return $checkbox;
	}

}