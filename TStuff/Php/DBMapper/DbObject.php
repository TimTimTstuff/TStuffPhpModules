<?php


namespace TStuff\Php\DBMapper   {
    use TStuff\Php\Transform as T;
    use TestClass\DbUser;
  abstract class DbObject implements TDbObjectQueries  {
         
        protected $tableName;
        protected $data;
        
        public function __construct(?array $data = null){
            if($data != null){
                $this->data = $data;
              
            }
           
        }

        /**
         * Returns an Metadata Array of the child class
         *
         * @return array
         */
        public static function getMetadata():array{
            $meta = array();
            $reflection = new \ReflectionClass(get_called_class());
            $result = array();
            $result["class_name"] = $reflection->getShortName();
            $result["table_name"] = T\TextTransform::CamelCaseToSnakeCase($result["class_name"]);
            $result["namespace"] = $reflection->getNamespaceName();
            $result["parent"] = $reflection->getParentClass()->getName();
            $docData = T\PhpDocParser::getDocAsArray(get_called_class());
            $fieldMeta = array();
            foreach ($docData as $key => $value) {
                $meta = array();
                $fieldName = T\TextTransform::CamelCaseToSnakeCase($key);
                $meta["field_name"] = $fieldName;
                foreach ($value as $k => $v) {

                
                if($k == "var" && !isset($meta['type'])){
                    $meta["type"] = $v;
                }else if($k == "DBMapper"){
                    $mapperData = json_decode($v,true);
                    $meta = array_merge($meta,$mapperData);
                }
             }
                $fieldMeta[$key] = $meta;

            }
            $result["field_meta"] = $fieldMeta;
            return $result;
        }

        public function save(){
            
        }

        public function remove(){

        }

        public static function single(string $query):DbObject{
           
            return new DbUser();
        }
        
        public static function singleOrDefault(string $query,?DbObject $default = null):?DbObject{
            return null;
        }
        public static function first(string $query):?DbObject{
            return null;
        }
        public static function firstOrDefault(string $query,?DbObject $default = null):?DbObject{
            return null;
        }
        public static function all(string $query):array{
            return null;
        }
        public static function delete(array $objects):void{

        }
        public static function update(array $objects):void{}

        public static function deleteBy(string $query):void{

        }
        public static function updateBy(string $query,array $fieldValueArray):void{

        }

        public static function create(DbObject $object):DbObject{
            return null;
        }

        public static function createAll(array $objects):array{
            return null;
        }
    }
}