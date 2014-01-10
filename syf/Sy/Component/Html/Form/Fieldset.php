<?php
namespace Sy\Component\Html\Form;

class Fieldset extends FieldContainer {

	/**
	 * @var \Sy\Component\Html\Element
	 */
	private $legend;

	/**
	 * @param string $label
	 * @param array $attributes
	 */
	public function __construct($label = null, array $attributes = array()) {
		parent::__construct('fieldset');
		$this->setAttributes($attributes);
		$label = trim($label);
		if (!empty($label)) {
			$legend = new \Sy\Component\Html\Element('legend');
			$legend->addText($label);
			$this->legend = $this->addElement($legend);
		}
	}

	/**
	 * @return \Sy\Component\Html\Element
	 */
	public function getLegend() {
		return $this->legend;
	}

}
