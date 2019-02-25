<?php

use TestClass\DbUser;
use TestClass\DbProducts;
use TStuff\Php\Cache\TFileCache;
use TStuff\Php\DBMapper\DbObject;
use TStuff\Php\DBMapper\TDBMapper;
use TStuff\Php\DBMapper\Queries\TDbQueryObject;

/** @var \PDO $pdo */
$mapper = new TDBMapper($pdo,TFileCache::getInstance(CACHE_PATH));



//print_r(DbUser::getMetadata());


$x = new TDbQueryObject();
$x->table = "db_user";
$x->field = "name,password,last_login,is_admin";


$y = new DbUser();
$y->name = "timo2";
$y->lastLogin = time();
$y->password = "test";
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

//DbProducts::deleteBy("1=1");

$products = DbProducts::all("1 = 1");

/** @var DbProducts $v */
foreach($products as $v){
    echo $v->getPrimaryFieldValue()." - ". $v->name." Stock: $v->inStock"." <br/>";
}

//print_r(DbProducts::single("product_id > 1"));

//DbProducts::delete($products);

/**
 * @var DbUser[] $myUsers
 */
$myUsers = DbUser::all(" 1=1 ");

foreach($myUsers as $k => $u){
    echo $u->getPrimaryFieldValue()." - ". $u->name." <br/>";
    

}

DbProducts::deleteBy("in_stock > 1");


DbProducts::updateBy("name like '%first%'",array("in_stock"=>10));
