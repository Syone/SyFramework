<?php
namespace Sy\Component\Html\Form;

class RadioSet extends InputSet {

	protected function addInputIn($id, $value, $label, $options = array()) {
		$radio = $this->addRadio(
			array(
				'name'  => $this->name,
				'value' => $value,
				'id'    => $id,
			),
			array('label' => $label)
		);
		if (!empty($options)) $radio->setOptions($options);
		if ($this->checked === $value) $radio->setAttribute('checked', 'checked');
		return $radio;
	}

}