<?php

spl_autoload_register(function($class){

	$prefix = "Modul\\";
	$prefixLength = strlen($prefix);

	$baseDir = __DIR__ . "/src/";

	$className = substr($class, $prefixLength);
	$classFile = $baseDir . $className . ".php";

	if(file_exists($classFile)){
		include $classFile;
	}


});