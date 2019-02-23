<?php
namespace TStuff\Php\DBMapper\Queries;

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
    public static $defaultUpdate = "UPDATE {table} SET ({fields_update})  WHERE {where}";
    public static $defaultInsert = "INSERT INTO {table} ({fields}) VALUES ({field_values_insert})";
    public static $defaultDelete = "DELETE FROM {table} WHERE {where}";

    //update field template
    public static $updateFieldTemplate = "{field} = {value}";

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

    /**
     * Creates the query for the table
     *
     * @todo refactor this function
     * 
     * @param \PDO $pdo
     * @param string $queryType (insert, update, create, delete)
     * @param TDbQueryObject $replacementObject
     * @return string sql query
     */
    public static function buildQuery(\PDO $pdo, string $queryType, TDbQueryObject $replacementObject) : string
    {

        $replace = array_values((array)$replacementObject);


        if ($replacementObject->fields != null) {
            //2 = fields
            $replace[2] = implode(", ", $replacementObject->fields);
        }

        if ($replacementObject->field_values_insert != null) {
            //3 = field_values_insert
            $replace[3] = self::getFormatedValues($replacementObject->field_values_insert,$pdo);

        }

        if ($replacementObject->values != null) {

            //7 = values
           $replace[7] = self::getFormatedValues($replacementObject->values,$pdo);
        }

        return str_replace(self::getSearchArray($replacementObject), $replace, self::getTemplate($queryType));
    }

    private static function getFormatedValues(array $input, \PDO $pdo)
    {
        $v = [];
        foreach ($input as $innerKey => $innerValue) {

            switch (strtolower(gettype($innerValue))) {
                case "boolean":
                    $v[] = $innerValue === true ? 1 : 0;
                    break;
                case "null":
                    $v[] = "NULL";
                    break;
                case "integer":
                case "double":
                    $v[] = $innerValue;
                    break;
                case "string":
                    $v[] = $pdo->quote($innerValue);
                    break;
                default:
                    $v[] = $pdo->quote(json_encode($innerValue));
                    break;

            }

        }
        return implode(", ", $v);
    }

    private static function getSearchArray(TDbQueryObject $replacementObject) : array
    {

        $search = array_keys((array)$replacementObject);
        $tSearch = [];
        foreach ($search as $key => $value) {
            $tSearch[] = "{" . $value . "}";
        }
        return $tSearch;
    }

    private static function getTemplate(string $queryType) : string
    {

        switch (strtolower(trim($queryType))) {
            case "insert":
                return self::$defaultInsert;
                break;
            case "update":
                return self::$defaultUpdate;
                break;
            case "delete":
                return self::$defaultDelete;
                break;
            case "select":
                return self::$defaultSelect;
                break;
            default:
                return "";


        }
    }





}