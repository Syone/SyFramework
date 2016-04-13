<?php
namespace Sy\Generator;

use Sy\Code\Classe;

class ClassFile extends File {

	public function __construct($path, Classe $class) {
		$classname = str_replace('\\', DIRECTORY_SEPARATOR, $class->getName());
		parent::__construct($path . DIRECTORY_SEPARATOR . $classname . '.php', '<?php' . PHP_EOL . $class->__toString());
	}

}