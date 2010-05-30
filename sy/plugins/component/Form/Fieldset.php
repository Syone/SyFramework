<?php
namespace Sy\Form;

class Fieldset extends Container {

	private $legend;

	public function __construct($legend = NULL) {
		parent::__construct();
		$this->usePhpTemplate();
		$this->setTemplateRoot(__DIR__ . '/templates');
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
