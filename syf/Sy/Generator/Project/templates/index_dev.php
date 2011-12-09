<?php
require __DIR__ . '/protected/conf/inc.php';

// Accessible only for development environment
$whitelist = array('localhost', '127.0.0.1');
if (!in_array($_SERVER['HTTP_HOST'], $whitelist)) header('location: index.php');

// Activate debug tools
$debugger = Sy\Debug\Debugger::getInstance();
$debugger->enableWebLog();
$debugger->enableTimeRecord();
$debugger->enableFileLog(__DIR__ . '/protected/log/app.log');
$debugger->enableTagLog(__DIR__ . '/protected/log');

// Activate the web debug tool bar
$app = new {PROJECT_NAME}\Component\Application();
$app->enableDebugBar();
echo $app;