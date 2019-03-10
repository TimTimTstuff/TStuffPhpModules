<?php


use TStuff\Php\DI as DI;
use TestClass as T;
use TestClass\UserHandler;




$in = new DI\TInject();


/** @var array $_SESSION */
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

//register PDO as a service
$in->RegisterService("db",function(DI\TInject $c){

    try{
    $pdo =  new PDO(
       DB_DSN,
       DB_USER,
       DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]//options
    );
    return $pdo;
    }catch(\PDOException $e){
        /**
         * @var TestClass\PrintMessage $print
         */
        $print = $c->getService("msg");

        $print->print($e->getMessage());

    }
    return null;
});
