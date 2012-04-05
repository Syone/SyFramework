<?php
namespace Sy;

function autoload($class) {
	if (\file_exists($file = __DIR__ . \DIRECTORY_SEPARATOR .\str_replace('\\', \DIRECTORY_SEPARATOR, $class) . '.php'))
		require $file;
}

spl_autoload_register('Sy\\autoload');
