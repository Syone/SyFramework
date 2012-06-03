<?php
namespace Sy\Code;

use Sy\Component;

class Parameter extends Component {

	private $type;
	private $name;
	private $defaultValue;

	public function __construct($name, $defaultValue = NULL) {
		parent::__construct();
		$this->setTemplateFile(__DIR__ . '/templates/Parameter.tpl');
		$this->type = NULL;
		$this->name = $name;
		$this->defaultValue = $defaultValue;
	}

	public function getName() {
		return $this->name;
	}

	public function getType() {
		return $this->type;
	}

	public function setType($type) {
		$this->type = $type;
	}

	public function __toString() {
		$this->setVar('NAME', $this->name);
		if (!is_null($this->type)) $this->setVar('TYPE', $this->type . ' ');
		if (!is_null($this->defaultValue)) $this->setVar('DEFAULT_VALUE', ' = ' . $this->defaultValue);
		return parent::__toString();
	}

}