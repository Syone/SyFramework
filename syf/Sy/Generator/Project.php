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
		$this->generateClass($this->name . '/Component/Application');
		$this->generateFile('index');
		$this->generateFile('index_dev');
		$this->generateFile('conf/conf');
		$this->generateFile('conf/conf.default');
		$this->generateFile('conf/inc');
	}

	private function generateClass($name) {
		$namespace = str_replace('/', '\\', dirname($name));
		$classname = basename($name);
		$c = new Classe($namespace, $classname);
		$this->createFile($this->path . '/' . $name . '.php', '<?php' . PHP_EOL . $c->__toString());
	}

	private function generateFile($name) {
		$c = new Component();
		$c->setTemplateFile(__DIR__ . "/Project/templates/$name.tpl");
		$c->setVar('PROJECT_NAME', $this->name);
		$this->createFile($this->path . '/' . $name . '.php', $c->__toString());
	}

	private function createFile($file, $content) {
		$dir = dirname($file);
		if (!file_exists($dir)) mkdir($dir, '0777', true);
		file_put_contents($file, $content);
	}

}