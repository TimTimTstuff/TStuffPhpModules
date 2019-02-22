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
use TStuff\Php\DBMapper\Queries\TDbQueryObject;


$mapper = new TDBMapper($pdo,TFileCache::getInstance(CACHE_PATH));

$x = DbUser::single("something");
$y = DbProducts::single("");

//print_r(DbUser::getMetadata());


$x = new TDbQueryObject();
$x->table = "db_user";
$x->field = "name,password,last_login,is_admin";


$y = new DbUser();
$y->name = "timo2";
$y->lastLogin = time();
$y->password = "massword";
$y->isAdmin = true;


//DbUser::create($y);

$p = new DbProducts();
$p->description = "Product 1";
$p->inStock = 5;
$p->ownerUserId = 1;
$p->price = 5.52;
$p->soldAmount = 0;
$p->tax = 19;
$p->name = "My first Product";
$p2 = new DbProducts();
$p2->description = "Product 2";
$p2->inStock = 3;
$p2->ownerUserId = 2;
$p2->price = 5.55;
$p2->soldAmount = 5;
$p2->tax = 7;
$p2->name = "My second Product";

DbProducts::createAll([$p,$p2]);

DbProducts::deleteBy("1=1");

$products = DbProducts::all("1 = 1");

foreach($products as $v){
    echo $v->name." <br/>";
}

//DbProducts::delete($products);

/**
 * @var DbUser[] $myUsers
 */
$myUsers = DbUser::all(" 1=1 ");

foreach($myUsers as $k => $u){
    echo $u->name." <br/>";
    

}

DbUser::delete(DbUser::all("1=1 limit 1, 100"));
