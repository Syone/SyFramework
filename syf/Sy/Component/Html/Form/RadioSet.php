<?php
namespace Sy\Component\Html\Form;

class RadioSet extends InputSet {

	protected function addInputIn($id, $value, $label) {
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

}