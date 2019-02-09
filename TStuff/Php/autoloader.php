<?php


function tstuff_auto_loader($class)
{
    $filename = BASE_PATH . str_replace('\\', '/', $class) . '.php';
   // echo $class."<br/>";
    include($filename);
}
spl_autoload_register('tstuff_auto_loader');