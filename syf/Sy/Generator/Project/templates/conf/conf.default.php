<?php
// Client path to project root directory starting at document root.
define('WEB_ROOT', '');

// Server path to SyFramework source directory
define('SY_PATH', 'syf');

// Server path to SyComponents source directory
define('SYC_PATH', 'syc');

//------------------------------------------------------------------------------
// Action trigger
//------------------------------------------------------------------------------
// The action trigger refers to the method to call from {PROJECT_NAME}\Component\Application
//------------------------------------------------------------------------------
// Example:
// define('ACTION_TRIGGER', 'p');
// http://my.domain.com/index.php?p=home
//------------------------------------------------------------------------------
define('ACTION_TRIGGER', 'p');

// Database informations
define('HOST'    , 'localhost');
define('DATABASE', '');
define('USERNAME', '');
define('PASSWORD', '');
define('DSN'     , 'mysql:host=' . HOST . ';dbname=' . DATABASE);