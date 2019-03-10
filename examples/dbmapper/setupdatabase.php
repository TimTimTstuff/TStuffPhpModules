<?php

use TStuff\Php\DBMapper\TDBMapper;
use TestClass\DbUser;
use TStuff\Php\DBMapper\DbObject;
use TStuff\Php\Cache\TFileCache;

/**@var \PDO $pdo */
$mapper = new TDBMapper($pdo, TFileCache::getInstance(CACHE_PATH));

$mapper->registerObject("TestClass\DbUser");
$mapper->registerObject("TestClass\TstuffPasswords");
$mapper->registerObject("TestClass\DbProducts");
$mapper->updateDatabase(true);

echo "Setup done";