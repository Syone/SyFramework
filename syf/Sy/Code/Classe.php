<?php
namespace Sy\Code;

use Sy\Component;

class Classe extends Component {

	private $namespace;
	private $usedClasses;
	private $abstract;
	private $name;
	private $extendedClass;
	private $implementedInterfaces;
    private $properties;
    private $methods;

	public function __construct($namespace, $name) {
		parent::__construct();
		$this->setTemplateFile(__DIR__ . '/templates/Classe.tpl');
		$this->namespace = $namespace;
		$this->usedClasses = array();
		$this->abstract = false;
		$this->name = $name;
		$this->extendedClass = NULL;
		$this->implementedInterfaces = array();
		$this->properties = array();
		$this->methods = array();
	}

	public function getName() {
		return $this->namespace . '\\' . $this->name;
	}

	public function setUsedClasses(array $classes) {
		$this->usedClasses = $classes;
	}

	public function setAbstract($abtract) {
		$this->abstract = $abtract;
	}

	public function setExtendedClass($class) {
		$this->extendedClass = $class;
	}

	public function setImplementedInterfaces(array $interfaces) {
		$this->implementedInterfaces = $interfaces;
	}

	public function setProperties(array $properties) {
		$this->properties = $properties;
	}

	public function setMethods(array $methods) {
		$this->methods = $methods;
	}

	public function __toString() {
		$this->setVar('NAMESPACE', $this->namespace);
		if (!empty($this->usedClasses)) $this->generateUsedClasses();
		$this->setVar('NAME', $this->name);
		if ($this->abstract) $this->setVar('ABSTRACT', 'abstract ');
		if (!is_null($this->extendedClass)) $this->setVar('EXTENDS', ' extends ' . $this->extendedClass);
		if (!empty($this->implementedInterfaces)) $this->setVar('IMPLEMENTS', ' implements ' . implode(', ', $this->implementedInterfaces));
		if (!empty($this->properties)) $this->generateProperties();
		foreach ($this->methods as $method) {
			$this->setComponent('METHOD', $method);
			$this->setBlock('METHODS');
		}
		return parent::__toString();
	}

	private function generateUsedClasses() {
		foreach ($this->usedClasses as $className => $classAlias) {
			if (!is_integer($className)) $this->setVar('USE_CLASS', $className . ' as ');
			$this->setVar('AS_CLASS', $classAlias);
			$this->setBlock('USED_CLASSES');
		}
		$this->setVar('USED_CLASSES_EOL', PHP_EOL);
	}

	private function generateProperties() {
		foreach ($this->properties as $property) {
			$this->setComponent('PROPERTY', $property);
			$this->setBlock('PROPERTIES');
		}
		$this->setVar('PROPERTIES_EOL', PHP_EOL);
	}

}