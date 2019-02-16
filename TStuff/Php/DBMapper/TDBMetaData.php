<?php




namespace TStuff\Php\DBMapper;
use TStuff\Php\Cache\ITCache;
    abstract class TDBMetaData
    {

        private static $changeCategory = "db_meta";
        private static $cacheMetaKey = "meta";


        /**
         * Undocumented variable
         *
         * @var ITCache
         */
        private static $cache;

        public static function notifyUpdate(){
            if(self::$cache == null)return;
            self::$cache->invalidate(self::$changeCategory,self::$cacheMetaKey);
        }


        public static function setCache(ITCache $cache ){
            self::$cache = $cache;
        }

        public static function createClassMetadata(array $registeredClasses) : array
        {
            $meta = [];
            foreach ($registeredClasses as $value) {
                $obj = new $value();
                $m = $obj->getMetadata();
                $meta[$m["class_name"]] = $m;
            }
            return $meta;
        }

        public static function createDatabaseMeta(\PDO $pdo) : array
        {
            if(self::$cache != null && self::$cache->existsKey(self::$changeCategory,self::$cacheMetaKey)){
                return json_decode(self::$cache->getValue(self::$changeCategory,self::$cacheMetaKey),true);
            }
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
            self::$cache->storeValue(self::$changeCategory,self::$cacheMetaKey,json_encode($tables),60*60*24);
            return $tables;
        }
    }
