<?php

session_start();
define("BASE_PATH", $_SERVER['CONTEXT_DOCUMENT_ROOT'] . "/TStuffPhpModules/");
define("DB_DSN", "mysql:host=localhost;dbname=tstuff_test;charset=utf8mb4");
define("DB_USER", "root");
define("DB_PASS", "");
include(BASE_PATH . "TSTUFF/PHP/tstuff.php");

?>
<html>
    <head>
    </head>
    <body>
        <nav>
            <ul>
                <li><a href="?demo=setup">Setup {Requires mysql}</a></li>
                <li><a href="?demo=1">DI Test</a></li>
                <li><a href="?demo=2">Text Transform</a></li>
                <li><a href="?demo=3">WebApi</a></li>
            <!-- <li><a href="?demo=4"></a></li>
                <li><a href="?demo=5"></a></li>
                <li><a href="?demo=6"></a></li>
                <li><a href="?demo=7"></a></li>
                <li><a href="?demo=8"></a></li>
                <li><a href="?demo=9"></a></li>
                <li><a href="?demo=10"></a></li> -->
            </ul>
        </nav>
        <?php 
        switch ($_GET['demo'] ?? null) {
            case "setup":
                break;
            case "1":
                include("dicontainer.php");
                break;
            case "2":
                include("texttransform.php");
                break;
            case "3":
                include("api.php");
                break;
            default:
                echo "Choose a demo";
                break;
        }
        ?>
    </body>
</html>
