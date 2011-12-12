<?php
require __DIR__ . '/../conf/inc.php';

// Accessible only for development environment
$whitelist = array('localhost', '127.0.0.1');
if (!in_array($_SERVER['HTTP_HOST'], $whitelist)) header('location: index.php');

// Activate debug tools
$debugger = Sy\Debug\Debugger::getInstance();
$debugger->enableWebLog();
$debugger->enableTimeRecord();
$debugger->enableFileLog(__DIR__ . '/../log/app.log');
$debugger->enableTagLog(__DIR__ . '/../log');

// Activate the web debug tool bar
$app = new {PROJECT_NAME}\Application();
$app->enableDebugBar();
echo $app;