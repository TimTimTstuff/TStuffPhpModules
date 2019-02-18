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
        "values" => ""

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

    public static function buildQuery(\Pdo $pdo, string $queryType, TDbQueryObject $replacementObject):string
    {
        $queryTemplate = "";
        switch (strtolower(trim($queryType))) {
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
        $tSearch = [];
        foreach ($search as $key => $value) {
            $tSearch[] = "{" . $value . "}";
        }

        $replace = array_values((array)$replacementObject);
        
        foreach ($replace as $key => $value) {
            if ($key == 2 && $value != null) {
                $replace[$key] = implode(", ", $value);
            } elseif ($key == 3 && $value != null) {
                $v = [];
                foreach ($value as $innerKey => $innerValue) {

                    switch (strtolower(gettype($innerValue))) {
                        case "boolean":
                            $replace[$key][$innerKey] = $innerValue === true ? 1 : 0;
                            break;
                        case "null":
                            $replace[$key][$innerKey] = "NULL";
                            break;
                        case "integer":
                        case "double":
                            $replace[$key][$innerKey] = $innerValue;
                            break;
                        case "string":
                            $replace[$key][$innerKey] = $pdo->quote($innerValue);
                            break;
                        default:
                            $replace[$key][$innerKey] = $pdo->quote(json_encode($innerValue));
                            break;

                    }

                }
                $replace[$key] = implode(", ",$replace[$key]);
            }

        }

        return str_replace($tSearch, $replace, $queryTemplate);
    }

    public static function sqlSingle($table, $where)
    {

    }






}