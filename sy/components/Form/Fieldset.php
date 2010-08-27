<?php
namespace Sy\Form;

class Fieldset extends FieldContainer {

	private $legend;

	public function __construct($legend = NULL) {
		parent::__construct();
		$this->setTemplateFile(__DIR__ . '/templates/Fieldset.tpl', 'php');
		$this->legend = $legend;
	}

	/**
	 * Set the fieldset legend
	 *
	 * @param string $legend
	 */
	public function setLegend($legend) {
		$this->legend = $legend;
	}

	public function __toString() {
		$this->setVar('LEGEND', $this->legend);
		return parent::__toString();
	}
	
}