<?php
session_start();
include("../config.php");
ini_set('display_errors', 1);
error_reporting(E_ALL);

include(BASE_PATH . "TStuff/Php/tstuff.php");
include("../inc/pdoconnect.php");

use TestClass\DbUser;
use TestClass\DbProducts;
use TStuff\Php\Cache\TFileCache;
use TStuff\Php\DBMapper\DbObject;
use TStuff\Php\DBMapper\TDBMapper;


$mapper = new TDBMapper($pdo,TFileCache::getInstance(CACHE_PATH));

$x = DbUser::single("something");
$y = DbProducts::single("");

print_r(DbUser::getMetadata());
