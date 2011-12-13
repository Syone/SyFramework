<?php
namespace {PROJECT_NAME};

require __DIR__ . '/conf.php';
require SY_PATH . '/sy.inc.php';
require SYC_PATH . '/sy.inc.php';

function autoload($class) {
	if (\file_exists($file = __DIR__ . \DIRECTORY_SEPARATOR . '..' . \DIRECTORY_SEPARATOR .\str_replace('\\', \DIRECTORY_SEPARATOR, $class) . '.php'))
		require $file;
}

spl_autoload_register('{PROJECT_NAME}\\autoload');