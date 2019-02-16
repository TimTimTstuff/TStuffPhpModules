<?php

use TStuff\Php\DBMapper\TDBMapper;
use TestClass\DbUser;
use TStuff\Php\DBMapper\DbObject;
use TStuff\Php\Cache\TFileCache;


DbObject::setCacheAdapter(TFileCache::getInstance(CACHE_PATH));
$mapper = new TDBMapper($pdo);

$mapper->registerObject("TestClass\DbUser");
$mapper->registerObject("TestClass\TstuffPasswords");
$mapper->registerObject("TestClass\DbProducts");
$mapper->updateDatabase();

echo "Setup done";