<?php
namespace Sy\Form;

class Fieldset extends FieldContainer {

	private $legend;

	public function __construct($legend = NULL) {
		parent::__construct();
		$this->setTemplateFile('Fieldset.tpl');
		$this->legend = $legend;
	}

	public function setLegend($legend) {
		$this->legend = $legend;
	}

	public function __toString() {
		$this->setVar('LEGEND', $this->legend);
		return parent::__toString();
	}
	
}
?>
