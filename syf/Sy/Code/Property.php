<?php
namespace Sy\Code;

use Sy\Component;

class Property extends Component {

	private $visibility;
	private $static;
	private $name;
	private $defaultValue;

	public function __construct($visibility, $name, $defaultValue = null) {
		parent::__construct();
		$this->setTemplateFile(__DIR__ . '/templates/Property.tpl');
		$this->visibility = $visibility;
		$this->name = $name;
		$this->defaultValue = $defaultValue;
		$this->static = false;
	}

	public function setStatic($static) {
		$this->static = $static;
	}

	public function __toString() {
		$this->setVar('VISIBILITY', $this->visibility);
		$this->setVar('NAME', $this->name);
		if ($this->static) $this->setVar('STATIC', ' static');
		if (!is_null($this->defaultValue)) $this->setVar('DEFAULT_VALUE', ' = ' . $this->defaultValue);
		return parent::__toString();
	}

}