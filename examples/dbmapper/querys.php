<?php
session_start();
include("../config.php");
ini_set('display_errors', 1);
error_reporting(E_ALL);

include(BASE_PATH . "TStuff/Php/tstuff.php");
include("../inc/pdoconnect.php");
use TestClass\DbUser;
use TestClass\DbProducts;


$x = DbUser::single("something");
$y = DbProducts::single("");


