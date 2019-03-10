
<?php

use TStuff\Php\Logging\LoggerFactory;
use TStuff\Php\Logging\LogLevel;
use TStuff\Php\Logging\DefaultLogger\FileLogger;
use TStuff\Php\Cache\TFileCache;
use examples\mvc\index\IndexController;
use TStuff\Php\DI\TInject;
use TestClass\DbIndexModel;


session_start();
include("../config.php");
ini_set('display_errors', 1);
error_reporting(E_ALL);

include(BASE_PATH . "TStuff/Php/tstuff.php");
include("../inc/pdoconnect.php");



$container = new TInject();


/* #region Container setup */

$container->RegisterService("logger",function($c){

    $logger = new LoggerFactory();
    $logger->registerLogger(new FileLogger("log"),[LogLevel::Debug,LogLevel::Error,LogLevel::Fatal,LogLevel::Info,LogLevel::Warning]);
    $logger->info("Logger Initialized with FileLogger",null,"Initialize");
    return $logger;

});

$container->RegisterService("cache",function ($c){

  return TFileCache::getInstance("cache");

});

$container->RegisterService("db",function ($c) {
    /**@var TInject $c */
    /**@var ITLogger $logger */
    $logger = $c->getService("logger");

    try{
        $pdo =  new PDO(
           DB_DSN,
           DB_USER,
           DB_PASS,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
               // PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ]//option   
        );
        $logger->info("PDO Initialized",null,"Initialize");
       return $pdo;
        }catch(\PDOException $e){
           
            $logger->error("Cant create connection",$e);
        }
        return null;
        
});

$container->RegisterService("dbmapper",function ($c){
 /**@var TInject $c */
    $mapper = $c->Instantiate("TStuff\Php\DBMapper\TDBMapper");
   
    /**@var TDBMapper $mapper */
    $mapper->registerObject("TestClass\DbIndexModel");
   
  

    $mapper->updateDatabase(true);
    return $mapper;

});

/* #endregion */

/** @var TInject $container */
$container->RegisterService("indexRepo",function($c){
      return  $c->Instantiate("examples\mvc\index\IndexRepository");
});


$container->RegisterService("indexCtrl",function($c){
    return $c->Instantiate("examples\mvc\index\IndexController");
});



///index data
/**@var IndexController $myController */
$myController = $container->getService("indexCtrl");

$myController->showModuleInformation();


