<?php
namespace Sy\Code;

use Sy\Component;

class Method extends Component {

	private $description;
	private $abstract;
	private $visibility;
	private $static;
	private $name;
	private $parameters;
	private $body;

	public function __construct($visibility, $name, $parameters = array()) {
		parent::__construct();
		$this->setTemplateFile(__DIR__ . '/templates/Method.tpl');
		$this->description = $name;
		$this->abstract = false;
		$this->visibility = $visibility;
		$this->name = $name;
		$this->parameters = $parameters;
		$this->static = false;
		$this->body = '';
	}

	public function setDescription($description) {
		$this->description = $description;
	}

	public function setAbstract($abstract) {
		$this->abstract = $abstract;
	}

	public function setStatic($static) {
		$this->static = $static;
	}

	public function setBody($body) {
		$this->body = $body;
	}

	public function addBody(array $lines) {
		$glue = empty($this->body) ? "\t\t" : "\n\t\t";
		$this->body .= $glue . implode("\n\t\t", $lines);
	}

	public function __toString() {
		if (!empty($this->description)) {
			$this->setVar('DESCRIPTION', $this->description);
			$this->setBlock('DESCRIPTION_BLOCK');
		}
		$this->setVar('VISIBILITY', $this->visibility);
		$this->setVar('NAME', $this->name);
		$this->setVar('BODY', $this->body);
		if ($this->abstract) $this->setVar('ABSTRACT', 'abstract ');
		if ($this->static) $this->setVar('STATIC', ' static');
		if (!empty($this->parameters)) $this->initParameters();
		if (strpos($this->body, 'return') !== false) {
			$this->setBlock('RETURN_BLOCK');
			$space = true;
		}
		if (isset($space)) $this->setBlock('SPACE');
		return parent::__toString();
	}

	private function initParameters() {
		$this->setVar('PARAMETERS', implode(', ', $this->parameters));
		foreach ($this->parameters as $parameter) {
			$this->setVar('PARAM_TYPE', is_null($parameter->getType()) ? 'type' : $parameter->getType());
			$this->setVar('PARAM_NAME', '$' . $parameter->getName());
			$this->setBlock('PARAMETERS_BLOCK');
		}
		$space = true;
	}

}