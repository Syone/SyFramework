<?php
namespace Sy\Form;

function autoload($class) {
	$class = str_replace('\\', '/', $class);
	$class = basename($class);
	if (file_exists($file = __DIR__ . "/$class.php")) {
		require_once $file;
	}
}

spl_autoload_register('Sy\Form\autoload');