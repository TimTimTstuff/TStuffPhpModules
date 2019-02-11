<?php


namespace TStuff\Php\DBMapper   {

   abstract class TDBMetaData  {

        public static function createClassMetadata(array $registeredClasses):array
        {
            $meta = [];
            foreach ($registeredClasses as $value) {
                $obj = new $value();
                $m = $obj->getMetadata();
                $meta[$m["class_name"]] = $m;
            }
            return $meta;
        }

        public static function createDatabaseMeta(\PDO $pdo):array
        {
             //get tables
            $tableList = $pdo->prepare("SHOW TABLES");
            $tableList->execute();
            $tables = [];

            foreach ($tableList->fetchAll() as $key => $value) {

                $tables[$value[0]] = null;
                $clm = $pdo->prepare("SHOW COLUMNS from " . $value[0]);
                $clm->execute();


                foreach ($clm->fetchAll(\PDO::FETCH_ASSOC) as $k => $v) {
                    $tables[$value[0]][$v['Field']] = $v;
                }


            }
           return $tables;
        }
    }
}