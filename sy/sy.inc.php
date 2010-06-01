<?php
namespace Sy;

include __DIR__ . '/sy.conf.php';

function autoload($class) {
	$class = str_replace('\\', '/', $class);
	$class = basename($class);
	if (file_exists($file = __DIR__ . "/core/$class.php")) {
		require_once $file;
	}
	else if (file_exists($file = __DIR__ . "/../" . PLUGIN . "/component/$class/$class.php")) {
		require_once $file;
	}
}

spl_autoload_register("Sy\autoload");
