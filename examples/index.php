<?php

session_start();
include("config.php");ini_set('display_errors', 1);
error_reporting(E_ALL);

include(BASE_PATH . "TStuff/Php/tstuff.php");
include("inc/pdoconnect.php");

?>
<html>
    <head>
    </head>
    <body>
    <script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
        <nav>
            <ul>
                <li><a href="?demo=setup">Setup {Requires mysql}</a></li>
                <li><a href="?demo=1">DI Test</a></li>
                <li><a href="?demo=2">Text Transform</a></li>
                <li><a href="?demo=3">WebApi</a></li>
             <li><a href="?demo=4">Reflection Doc Parser</a></li>
                <li><a href="?demo=5">Cache</a></li>
              <!--  <li><a href="?demo=6"></a></li>
                <li><a href="?demo=7"></a></li>
                <li><a href="?demo=8"></a></li>
                <li><a href="?demo=9"></a></li>
                <li><a href="?demo=10"></a></li> -->
            </ul>
        </nav>
        <div id='content'>
        <?php 
        switch ($_GET['demo'] ?? null) {
            case "setup":
                include("dbmapper/setupdatabase.php");
                break;
            case "1":
                include("di/dicontainer.php");
                break;
            case "2":
                include("transform/texttransform.php");
                break;
            case "3":
                include("api/api.php");
                break;
            case "4":
                include("transform/tt_reflection.php");    
            break;
            case "5":
                include("cache/cachtest.php");
            break;
            default:
                echo "Choose a demo";
                break;
        }
        ?>
        </div>
    </body>
</html>
<?PHP


