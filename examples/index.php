<?php

session_start();

include(BASE_PATH . "TSTUFF/PHP/tstuff.php");
include("inc/pdoconnect.php");

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
             <li><a href="?demo=4">Reflection Doc Parser</a></li>
              <!--  <li><a href="?demo=5"></a></li>
                <li><a href="?demo=6"></a></li>
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
            default:
                echo "Choose a demo";
                break;
        }
        ?>
        </div>
    </body>
</html>
