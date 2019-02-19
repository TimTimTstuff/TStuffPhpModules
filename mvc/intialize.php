<?php

include "autoloader.php";

$container = new Modul\Core\Container;

$indexController = $container->create("indexController");
$indexController->showModulInformations();