<?php

namespace TStuff\Php\DBMapper;
use TStuff\Php\Transform\TextTransform;
use TStuff\Php\Cache\ITCache;
    class TDBMapper
    {

        /**
         * Undocumented variable
         *
         * @var \PDO
         */
        private $database;

        private $registeredClasses = [];
        private $cachedRegisterClass = [];

        private $databaseMeta;
        private $classMeta;

        /**
         * Undocumented variable
         *
         * @var ITCache
         */
        private $cache;



        /**
         * Undocumented function
         *
         * @param \PDO $db
         */
        public function __construct(\PDO $db, ?ITCache $cache)
        {
            $this->database = $db;
            $this->cache = $cache;
            if($this->cache != null){
                TDBMetaData::setCache($cache);
                DbObject::setCacheAdapter($cache);
            }
            if($this->cache != null && $cache->existsKey("dbmapper","class")){
                $this->cachedRegisterClass = json_decode($cache->getValue("dbmapper","class"),true);
            }
        }

        public function registerObject(string $className) : void
        {
            if(in_array($className, $this->registeredClasses)) throw new \Exception("Class: $className already exists!");
            if(!in_array($className,$this->cachedRegisterClass)){
                $this->cachedRegisterClass[] = $className;
                $this->refreshMetadata();
                $this->cache->storeValue("dbmapper","class",json_encode($this->cachedRegisterClass));
            }
            $this->registeredClasses[] = $className;
        }

        private function createSqlForClass(string $className)
        {
            /**
             * @var DbObject $classObject
             */

           // $classObject = new $className();
            $classMetadata = $className::getMetadata();
          
            $tableMapper = new TDBTableBuilder($classMetadata["table_name"], "InnoDB");

            //for each public property in class
            foreach ($classMetadata["field_meta"] as $propertyName => $value) {
                //create primary Field
                if (isset($value['index']) && $value['index'] == "primary") {

                    $ai = $value['auto_increment'] ?? false;
                    $tableMapper->addPrimayField($value['field_name'], $value['type'], $ai);

                } //create other fields
                else 
                {
                    $this->addFieldToMapper($tableMapper,$classMetadata["class_name"],$propertyName);
                }
            }
            //return sql code for the table
            return $tableMapper->getSql();
        }

        private function addFieldToMapper(TDBTableBuilder $tb, string $className, string $fieldName){
            $value = $this->classMeta[$className]["field_meta"][$fieldName];
            $tb->addField(
                $value['field_name'],
                $value['type'],
                $value['notnull'] ?? false,
                $value['size'] ?? null,
                $value['default'] ?? null,
                $value['index'] ?? null
            );
        }

        private function createTableFromClass($className)
        {
            $s = $this->createSqlForClass($className);

            try {
                $this->database->exec($s);

            } catch (\PDOException $e) {

                echo $e->getMessage();
            }
        }

        public function createDatabase()
        {
            foreach ($this->registeredClasses as $className) {
                $this->createTableFromClass($className);
            }
        }


        private function refreshMetadata(){
              TDBMetaData::notifyUpdate();
                DbObject::notifyUpdate();
        }

        public function updateDatabase(bool $force = false)
        {
            if($force){
              $this->refreshMetadata();
            }

            $sqlExecutes = [];
            $this->databaseMeta = TDBMetaData::createDatabaseMeta($this->database);
            $this->classMeta = TDBMetaData::createClassMetadata($this->registeredClasses);

            foreach ($this->classMeta as $propertyName => $classMetadata) {

                $tableName = $classMetadata['table_name'];

                if (!array_key_exists($tableName, $this->databaseMeta)) {
                    $this->createTableFromClass($classMetadata['namespace'] . "\\" . $classMetadata['class_name']);
                    TDBMetaData::notifyUpdate();
                }else{
                    
                    foreach($classMetadata['field_meta'] as $propname => $data){             
                        //create field
                        if(!array_key_exists($data['field_name'],$this->databaseMeta[$tableName])){
                            //use tb field
                            //$data = $this->getFieldCreateArray($value,$propname);
                            $sql = TDBTableBuilder::getAddColumnSql($tableName,  $data['field_name'],
                            $data['type'],
                            $data['notnull'] ?? false,
                            $data['size'] ?? null,
                            $data['default'] ?? null,
                            $data['index'] ?? null);
                            $sqlExecutes[] = $sql;
                        }else{
                            //change field
                        }
                    }
                    
                    //remove fields
                    foreach ($this->databaseMeta[$tableName] as $f => $prop) {
                        if(!array_key_exists(TextTransform::SnakeCaseToCamelCase($f),$classMetadata["field_meta"])){
                            $sql = TDBTableBuilder::getDeleteColumnSql($tableName,$f);
                            $sqlExecutes[] = $sql;
                        }
                    }
                }
            }
          
            foreach ($sqlExecutes as  $sql) {
                try{
                    $this->database->exec($sql);
                    //@todo for debug
                    
                }catch(\PDOException $ex){
                    throw $ex;
                }
            }

        }

    }
