<?php

use TStuff\Php\Cache\TFileCache;
session_start();
include("../config.php");


include(BASE_PATH . "TStuff/Php/tstuff.php");


$x = TFileCache::getInstance(CACHE_PATH);

