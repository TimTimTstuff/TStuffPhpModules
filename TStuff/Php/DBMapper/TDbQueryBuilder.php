<?php
namespace TStuff\Php\DBMapper;

abstract class TDbQueryBuilder
{

    public static $replacementArray = [
        "fields" => "",
        "table" => "",
        "where" => "",
        "field_values_insert" => "",
        "field" => "",
        "offset" => "",
        "count" => "",
        "values" =>""

    ];

    public static $logicOperators = [
        "eq" => "=",
        "neq" => "!=",
        "lt" => "<",
        "gt" => ">",
        "leq" => "<=",
        "geq" => ">="
    ];

    public static $likeOperators = [
        "startsWith" => "%{value}",
        "endsWith" => "{value}%",
        "contains" => "%{value}%"
    ];

    //Default CRUD
    public static $defaultSelect = "SELECT {fields} FROM {table} WHERE {where} ";
public static $defaultUpdate = "UPDATE {table} WHERE {where}";
    public static $defaultInsert = "INSERT INTO {table} ({fields}) VALUES ({field_values_insert})";
    public static $defaultDelete = "DELETE FROM {table} WHERE {where}";

   //Extended Filter
    public static $orderBy = "ORDER BY {field}";
    public static $orderByDesc = "ORDER BY {field} DESC";
    public static $limit = "LIMIT {offset}, {count}";

    //conditions
    public static $logicOperator = "{field} {logic_operator} {value}";
    public static $likeOperator = "{field} LIKE {like_value}";
    public static $notLikeOperator = "{field} NOT LIKE {like_value}";
    public static $isNull = "{field} IS NULL";
    public static $isNotNull = "{field} IS NOT NULL";
    public static $in = "{field} IN ({values})";
    public static $notIn = "{field} NOT IN ({values})";
    
    public static function buildQuery(string $queryType, TDbQueryObject $replacementObject){
        $queryTemplate = "";
        switch(strtolower(trim($queryType))){
            case "insert":
                $queryTemplate = self::$defaultInsert;
            break;
            case "update":
                $queryTemplate = self::$defaultUpdate;
            break;
            case "delete":
                $queryTemplate = self::$defaultDelete;
            break;
            case "select":
                $queryTemplate = self::$defaultSelect;
            break;
        }      
        $search = array_keys((array)$replacementObject);
        $replace = array_values((array)$replacementObject);
        return str_replace($search,$replace,$queryTemplate);
    }

    public static function sqlSingle($table, $where){
        
    }






}