<?php

use TStuff\Php\DBMapper\TDBMapper;
use TestClass\DbUser;
session_start();
define("BASE_PATH", $_SERVER['CONTEXT_DOCUMENT_ROOT'] . "/TStuffPhpModules/");
define("DB_DSN", "mysql:host=localhost;dbname=tstuff_test;charset=utf8mb4");
define("DB_USER", "root");
define("DB_PASS", "");
include(BASE_PATH . "TSTUFF/PHP/tstuff.php");

try{
    $pdo =  new PDO(
       DB_DSN,
       DB_USER,
       DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
           // PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]//options
    );
   
    }catch(\PDOException $e){
      
        print_r($e);
    }


$mapper = new TDBMapper($pdo);

$mapper->registerObject("TestClass\DbUser");
$mapper->updateDatabase();