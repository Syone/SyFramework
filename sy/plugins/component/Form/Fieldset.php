<?php
namespace Sy\Form;

class Fieldset extends Element {

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

	public function addInput($attributes, $options = array()) {
		$input = new Input();
		$input->setAttributes($attributes);
		$input->setOptions($options);
		$this->addElement($input);
	}

	public function __toString() {
		$this->setVar('LEGEND', $this->legend);
		return parent::__toString();
	}
	
}
?>
