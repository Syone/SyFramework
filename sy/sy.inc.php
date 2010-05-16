<?php

include __DIR__ . '/sy.conf.php';

function sy_autoload($class) {
	$class = basename($class);
	if (file_exists($file = __DIR__ . "/core/$class.php")) {
		require_once $file;
	}
}

spl_autoload_register("sy_autoload");
