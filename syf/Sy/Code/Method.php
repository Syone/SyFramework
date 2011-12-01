<?php
namespace Sy\Code;

use Sy\Component;

class Method extends Component {

	private $description;
	private $visibility;
	private $static;
	private $name;
	private $parameters;
	private $body;

	public function __construct($visibility, $name, $parameters = array()) {
		parent::__construct();
		$this->setTemplateFile(__DIR__ . '/templates/Method.tpl');
		$this->description = '';
		$this->visibility = $visibility;
		$this->name = $name;
		$this->parameters = $parameters;
		$this->static = false;
		$this->body = '';
	}

	public function setDescription($description) {
		$this->description = $description;
	}

	public function setStatic($static) {
		$this->static = $static;
	}

	public function setBody($body) {
		$this->body = $body;
	}

	public function __toString() {
		if (!empty($this->description)) {
			$this->setVar('DESCRIPTION', $this->description);
			$this->setBlock('DESCRIPTION_BLOCK');
		}
		$this->setVar('VISIBILITY', $this->visibility);
		$this->setVar('NAME', $this->name);
		$this->setVar('BODY', $this->body);
		if ($this->static) $this->setVar('STATIC', ' static');
		if (!empty($this->parameters)) {
			$this->setVar('PARAMETERS', implode(', ', $this->parameters));
			foreach ($this->parameters as $parameter) {
				$this->setVar('PARAM_TYPE', is_null($parameter->getType()) ? 'type' : $parameter->getType());
				$this->setVar('PARAM_NAME', '$' . $parameter->getName());
				$this->setBlock('PARAMETERS_BLOCK');
			}
		}
		return parent::__toString();
	}

}