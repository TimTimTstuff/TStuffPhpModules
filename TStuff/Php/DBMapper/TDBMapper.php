<?php


namespace TStuff\Php\DBMapper {

    class TDBMapper
    {

        /**
         * Undocumented variable
         *
         * @var \PDO
         */
        private $database;

        private $registeredClasses = [];

        /**
         * Undocumented function
         *
         * @param \PDO $db
         */
        public function __construct($db)
        {
            $this->database = $db;
        }

        public function registerObject(string $className) : void
        {
         
            if (!in_array($className, $this->registeredClasses)) {
                $this->registeredClasses[] = $className;
             
            }
        }

        private function createSqlForClass(string $className)
        {
            /**
             * @var DbObject $classObject
             */

            $classObject = new $className();
            $obj = $classObject->getMetadata();
            $this->registeredClasses[$obj['class_name']] = $obj;

            $tb = new TDBTableBuilder($obj["table_name"], "InnoDB");

            foreach ($obj["field_meta"] as $key => $value) {
                if (isset($value['index']) && $value['index'] == "primary") {
                    $ai = $value['auto_increment'] ?? false;
                    $tb->addPrimayField($key, $value['type'], $ai);

                } else {

                    $tb->addField(
                        $key,
                        $value['type'],
                        $value['notnull'] ?? false,
                        $value['size'] ?? null,
                        $value['default'] ?? null,
                        $value['index'] ?? null
                    );

                }
            }

            return $tb->getSql();


        }

        public function createDatabase()
        {
            foreach ($this->registeredClasses as $className) {
                $s = $this->createSqlForClass($className);
               
                try {
                    $this->database->exec($s);

                } catch (\PDOException $e) {
                   
                    echo $e->getMessage();
                }
            }
        }


    }
}