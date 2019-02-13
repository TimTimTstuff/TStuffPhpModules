<?php

use TStuff\Php\Cache\TFileCache;



$x = TFileCache::getInstance(CACHE_PATH);

$testResult = [];

$testResult["Exist Key No"] = $x->existsKey("test","1");
$x->storeValue("test","2",true,1000);
$testResult["Exist Key Yes"] = $x->existsKey("test","2");
$testResult["Has value true"] = $x->getValue("test","2");
$x->invalidate("test","2");
$testResult["Exist key No"] = $x->existsKey("test","2");
//$x->invalidate("test");
//$testResult["exist key"] = $x->existsKey("test","2");


var_dump($testResult);

print_r($x);
