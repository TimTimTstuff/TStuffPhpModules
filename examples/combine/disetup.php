<?php

use TStuff\Php\DI\TInject;
use TSTUFF\Php\DI\TInjectTypes;
use TStuff\Php\Cache\TFileCache;

$inject = new TInject();

$inject->RegisterService("cache",function($c){
    return TFileCache::getInstance(CACHE_PATH);
},TInjectTypes::MultiUse);

$inject->RegisterService("db",$pdo);

$inject->RegisterService("dbMapper",function($c){
    /**
     * @var Tinject $c
     */
   return $c->Instantiate("TStuff\Php\DBMapper\TDBMapper");
});
