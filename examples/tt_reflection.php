<?php

use TStuff\Php\Transform\PhpDocParser;
session_start();
define("BASE_PATH", $_SERVER['CONTEXT_DOCUMENT_ROOT'] . "/TStuffPhpModules/");
define("DB_DSN", "mysql:host=localhost;dbname=tstuff_test;charset=utf8mb4");
define("DB_USER", "root");
define("DB_PASS", "");
include(BASE_PATH . "TSTUFF/PHP/tstuff.php");


print_r(PhpDocParser::getDocAsArray("TestClass\DbUser"));
