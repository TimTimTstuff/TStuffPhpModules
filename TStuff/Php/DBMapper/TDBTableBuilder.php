<?php

/**
 * Target: 
 * CREATE TABLE `tstuff_test`.`test` 
 * ( 
 * `id` INT NOT NULL AUTO_INCREMENT , 
 * `name` VARCHAR(222) NOT NULL DEFAULT 'test' , 
 * `datea` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP , 
 * 
 * PRIMARY KEY (`id`), UNIQUE (`id`, `name`)
 * 
 * ) ENGINE = InnoDB;
 */

namespace TStuff\Php\DBMapper {

    class TDBTableBuilder
    {

        private $fields = [];
        private $fieldPrimary;
        private $tableName;
        private $dbEngine;
        private $uniqueFields = [];

        private static $primaryFieldTemplate = "`{name}` {type} NOT NULL {AI}";
        private static $fieldTemplate = ", `{name}` {type} {not_null} NULL {default} ";
        private static $defaultValueTemplate = "DEFAULT {value}";
        private static $primaryTemplate = ", PRIMARY KEY (`{name}`)";
        private static $uniqueTemplate = ", UNIQUE ({fields})";
        private static $tableTemplate = "CREATE TABLE  {table} ( {content} ) ENGINE = {engine}";

        public function __construct(string $tableName, string $dbEngine)
        {
            $this->dbEngine = $dbEngine;
            $this->tableName = $tableName;
        }

        public function addPrimayField(string $name, string $type, bool $autoIncrement) : void
        {
            
            $this->fieldPrimary = [$name, $this->typeConverter($type), $autoIncrement?"AUTO_INCREMENT":""];
        }

        public function addField(string $name, string $type, bool $notNull, ?int $size, ?string $default, ?string $index) : void
        {
            $type = $this->typeConverter($type);

            if($type == "VARCHAR" && $size == null){
                $size = 500;
            }

            if($size != null){ 
                $type = $type."(".$size.")";
            }

            if($default != null){
                $default = str_replace("{value}","".$default."",self::$defaultValueTemplate);
            }
            $nn = "";
            if($notNull){
                $nn = "NOT";
            }
            if($index != null){
                if($index == "unique"){
                    $this->uniqueFields[] = $name;
                }
            }

            $this->fields[] = [$name, $type,$nn, $default];
        }

        public function getSql() : string
        {
          
          $content = "";
          //set primaryfield
          $content.= str_replace(array("{name}","{type}","{AI}"),$this->fieldPrimary,self::$primaryFieldTemplate);

          //set fields
          foreach ($this->fields as $field) {

                $content.= str_replace(array("{name}","{type}","{not_null}","{default}"),$field,self::$fieldTemplate);
          }

          //set primary
          $content.= str_replace("{name}",$this->fieldPrimary[0],self::$primaryTemplate);
          
          //set unique
          $fields = "`".$this->fieldPrimary[0]."`";
          foreach ($this->uniqueFields as  $value) {
              $fields.=",`".$value."`";
          }
          $content.= str_replace("{fields}",$fields,self::$uniqueTemplate);

          //build sql
          return str_replace(
            array("{table}","{content}","{engine}"),
            array($this->tableName,$content,$this->dbEngine),
            self::$tableTemplate);
        }

        private  function typeConverter($x):string{
            $x = trim($x);
            if($x == 'string') {
                return "VARCHAR";
            }

            return strtoupper($x);
        }

    }
}