<?php

use TStuff\Php\Logging\LoggerFactory;
use TStuff\Php\Logging\DefaultLogger\EchoLogger;
use TStuff\Php\Logging\LogLevel;
use TestClass\DbUser;
use TStuff\Php\Logging\DefaultLogger\FileLogger;
use TStuff\Php\DBMapper\TDBMapper;
use TStuff\Php\Cache\TFileCache;
use TStuff\Php\Logging\DefaultLogger\DBLogger;


session_start();
include("../config.php");
ini_set('display_errors', 1);
error_reporting(E_ALL);

include(BASE_PATH . "TStuff/Php/tstuff.php");
include("../inc/pdoconnect.php");


$logger = new LoggerFactory();

/** @var \PDO $pdo */
$mapper = new TDBMapper($pdo, TFileCache::getInstance(CACHE_PATH));

$logger->registerLogger(new EchoLogger(),[LogLevel::Trace,LogLevel::Debug,LogLevel::Info,LogLevel::Warning,LogLevel::Error,LogLevel::Fatal]);
$logger->registerLogger(new FileLogger(BASE_PATH."/log"),[LogLevel::Fatal,LogLevel::Error]);
$logger->registerLogger(new DBLogger($mapper),[LogLevel::Trace,LogLevel::Debug,LogLevel::Info,LogLevel::Warning,LogLevel::Error,LogLevel::Fatal]);
$mapper->updateDatabase(true);


$logger->log(LogLevel::Fatal,"My Fatal form Log",array());

$logger->trace("Hallo from Trace");

$logger->debug("Hallo from Debug",null,"Debug Category");

$x = new DbUser();
$x->name = "timo";
$x->lastLogin = time();

$logger->debug("Hallo from Info",$x,"Info Category");

try{
    throw new \BadFunctionCallException("Blub");
}catch(\Exception $e){
    $logger->setCategory("exception");
    $logger->error("Hallo from Error",$e);
    $logger->clearCategory();
}

$logger->fatal("Hallo from Fatal");