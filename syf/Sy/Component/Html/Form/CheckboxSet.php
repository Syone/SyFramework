<?php
namespace Sy\Component\Html\Form;

class CheckboxSet extends InputSet {

	protected function addInputIn($id, $value, $label) {
		$checkbox = $this->addCheckbox(
			array(
				'name'  => $this->name,
				'value' => $value,
				'id'    => $id,
			),
			array('label' => $label)
		);
		if ($this->checked === $value) $checkbox->setAttribute('checked', 'checked');
		return $checkbox;
	}

}