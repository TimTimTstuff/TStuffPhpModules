<?php

session_start();
define("BASE_PATH",$_SERVER['CONTEXT_DOCUMENT_ROOT']."/tests/");
include(BASE_PATH . "TSTUFF/PHP/tstuff.php");

use TStuff\Php\DI as DI;
use TestClass as T;
use TestClass\UserHandler;




$in = new DI\TInject();


//Register SessionHandler
$in->RegisterService("session", new T\SessionHelper($_SESSION), DI\TInjectTypes::AlwaysNew);


//register Print Message
$in->RegisterService("msg", new T\PrintMessage());


//register User
$in->RegisterService("user", function (DI\TInject $c) {
    //Use get service to load other Services

    /**
     * @var TestClass\SessionHelper $s 
     * @var TestClass\PrintMessage $m
     */
    $s = $c->getService("session");
    $m = $c->getService("msg");
    

    //Use a method from PrintMessage
    $m->print("Create User object as a Service");
    //Create a object and use methods from SessionHelper
    return new T\User($s->getValue("username") ?? "", $s->getValue("id") ?? -1);
});


//register UserHandler -> Use Instantiate
$in->RegisterService("UserHandler", function (DI\TInject $c) {
    //Use full name to create the service. UserHandler needs User and PrintMessage in the constructor
    return $c->Instantiate("TestClass\UserHandler");
});
