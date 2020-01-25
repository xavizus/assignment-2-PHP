<?php
session_start();
define("ROOT_DIR", __DIR__ . "/../");

function autoload($className) {
	$className = str_replace('\\', '/', $className);
	require(dirname(__FILE__) . '/classes/'.$className. '.class.php');
}

spl_autoload_register('autoload');

$config = new \Settings();

$test = new \database($config->getDatabaseConfig());
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
</body>
</html>