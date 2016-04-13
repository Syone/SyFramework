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
	private $type;

	public function __construct($path, $name, $type = 'public') {
		$this->path = $path;
		$this->name = $name;
		$this->type = $type;
	}

	public function generate() {
		if ($this->type === 'protected')
			$this->generateProtected();
		else
			$this->generatePublic();
	}

	public function generateComponent($name, $component = 'Sy\Component') {
		$class = new Classe($name);
		$class->setExtendedClass($component);
		$constructMethod = new Method('public', '__construct');
		$constructMethod->setDescription("{$class->getClassName()} constructor");
		$constructMethod->addBody(array(
			'parent::__construct();',
			'$this->setTemplateFile(__DIR__ . \'/templates/' . $class->getClassName() . '.html\');'
		));
		$class->setMethods(array($constructMethod));
		$classFile = new ClassFile($this->path, $class);
		$classFile->generate();
		$file = new File($this->path . '/' . str_replace('\\', '/', $name) . '/templates/' . $class->getClassName() . '.html');
		$file->generate();
	}

	public function generateClass($className, $extendedClassName = null) {
		$class = new Classe($className);
		$constructMethod = new Method('public', '__construct');
		$constructMethod->setDescription("{$class->getClassName()} constructor");
		if (!is_null($extendedClassName)) {
			$class->setExtendedClass($extendedClassName);
			$constructMethod->setBody("\t\tparent::__construct();");
		}
		$class->setMethods(array($constructMethod));
		$classFile = new ClassFile($this->path, $class);
		$classFile->generate();
	}

	private function generatePublic() {
		$this->copy('protected/Project/Application/templates/Application.html', $this->name . '/Application/templates/Application.html');
		$this->generateFile($this->name . '/Application.php', 'protected/Project/Application.thp');
		$this->generateFile('conf/conf.php', 'protected/conf/conf.thp');
		$this->generateFile('conf/conf.default.php', 'protected/conf/conf.default.thp');
		$this->generateFile('conf/inc.php', 'protected/conf/inc.thp');
		$this->generateFile('public/index.php', 'public/index.thp');
		$this->generateFile('public/index_dev.php', 'public/index_dev.thp');
	}

	private function generateProtected() {
		$this->copy('protected/Project/Application/templates/Application.html', 'protected/' . $this->name . '/Application/templates/Application.html');
		$this->generateFile('protected/' . $this->name . '/Application.php', 'protected/Project/Application.thp');
		$this->generateFile('protected/conf/conf.php', 'protected/conf/conf.thp');
		$this->generateFile('protected/conf/conf.default.php', 'protected/conf/conf.default.thp');
		$this->generateFile('protected/conf/inc.php', 'protected/conf/inc.thp');
		$this->generateFile('protected/.htaccess');
		$this->generateFile('index.php', 'index.thp');
		$this->generateFile('index_dev.php', 'index_dev.thp');
	}

	private function copy($src, $dest) {
		$dir = dirname($this->path . DIRECTORY_SEPARATOR . $dest);
		if (!file_exists($dir)) mkdir($dir, '0777', true);
		copy(__DIR__ . "/Project/templates/$src", $this->path . DIRECTORY_SEPARATOR . $dest);
	}

	private function generateFile($outputFile, $inputFile = null) {
		$c = new Component();
		$c->setTemplateFile(is_null($inputFile) ? __DIR__ . "/Project/templates/$outputFile" : __DIR__ . "/Project/templates/$inputFile");
		$c->setVar('PROJECT_NAME', $this->name);
		$file = new File($this->path . DIRECTORY_SEPARATOR . $outputFile, $c->__toString());
		$file->generate();
	}

}