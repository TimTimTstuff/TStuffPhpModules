<?php

use TStuff\Php\Transform\TextTransform;

session_start();
define("BASE_PATH",$_SERVER['CONTEXT_DOCUMENT_ROOT']."/tests/");
include(BASE_PATH . "TSTUFF/PHP/tstuff.php");


?>

<html>
<head>
    <style>
        table{
            border:solid 1px gray;
            border-collapse: collapse;
        }
        td{
            padding:4px;
            border-bottom: solid thin gray;
        }
       
    </style>
</head>
<body>
    <table>
        <tr>
            <th>Method</th>
            <th>Input</th>
            <th>Output</th>
        </tr>
        <tr>
            <td>CamelCaseToSnakeCase</td>
            <td>('ThatsACamelCaseText')</td>
            <td><?php echo TextTransform::CamelCaseToSnakeCase("ThatsACamelCaseText")  ?></td>
        </tr>
        <tr>
            <td>SnakeCaseToCamelCase(text,capitalize first letter)</td>
            <td>("thats_a_snake_case_text",false)</td>
            <td><?php echo TextTransform::SnakeCaseToCamelCase("thats_a_snake_case_text",false) ?></td>
        </tr>
        <tr>
            <td>SnakeCaseToCamelCase(text,capitalize first letter)</td>
            <td>("thats_a_snake_case_text",true)</td>
            <td><?php echo TextTransform::SnakeCaseToCamelCase("thats_a_snake_case_text",true) ?></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>
</body>
</html>