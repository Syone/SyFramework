<?php
namespace Sy\Generator;

use Sy\Component;
use Sy\Code\Classe;
use Sy\Code\Property;
use Sy\Code\Method;
use Sy\Code\Parameter;

class Project {

	private $path;
	private $name;

	public function __construct($path, $name) {
		$this->path = $path;
		$this->name = $name;
	}

	public function generate() {
		$this->generateApplicationClass();
		$this->generateFile($this->name . '/Component/Application/templates/Application.html', 'Project/Component/Application/templates/Application.html');
		$this->generateFile('index.php');
		$this->generateFile('index_dev.php');
		$this->generateFile('conf/conf.php');
		$this->generateFile('conf/conf.default.php');
		$this->generateFile('conf/inc.php');
	}

	private function generateApplicationClass() {
		$class = new Classe($this->name . '\Component', 'Application');
		$class->setUsedClasses(array('Sy\Component\WebComponent', 'Sy\Component\Html\Page'));
		$class->setExtendedClass('Page');
		$propertyBody = new Property('private', 'body');
		$class->setProperties(array($propertyBody));
		$methodConstruct = new Method('public', '__construct');
		$methodConstruct->setDescription('Application constructor');
		$methodConstruct->setBody(<<<'EOC'
		parent::__construct();
		$this->body = new WebComponent();
		$this->body->setTemplateFile(__DIR__ . '/Application/templates/Application.html');
		$this->init();
		$this->actionDispatch('p', 'home');
EOC
		);
		$methodToString = new Method('public', '__toString');
		$methodToString->setDescription('Return Application render');
		$methodToString->setBody(<<<'EOC'
		$this->setBody($this->body);
		return parent::__toString();
EOC
		);
		$class->setMethods(array($methodConstruct, $methodToString));
		$this->generateClass($class);
	}

	private function generateClass(Classe $class) {
		$classFile = new ClassFile($this->path, $class);
		$classFile->generate();
	}

	private function generateFile($outputFile, $inputFile = NULL) {
		$c = new Component();
		$c->setTemplateFile(is_null($inputFile) ? __DIR__ . "/Project/templates/$outputFile" : __DIR__ . "/Project/templates/$inputFile");
		$c->setVar('PROJECT_NAME', $this->name);
		$file = new File($this->path . DIRECTORY_SEPARATOR . $outputFile, $c->__toString());
		$file->generate();
	}

}