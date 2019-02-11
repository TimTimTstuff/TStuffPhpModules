<?php

use TStuff\Php\DBMapper\TDBMapper;
use TestClass\DbUser;



$mapper = new TDBMapper($pdo);

$mapper->registerObject("TestClass\DbUser");
$mapper->registerObject("TestClass\TstuffPasswords");
$mapper->registerObject("TestClass\DbProducts");
$mapper->updateDatabase();

echo "Setup done";