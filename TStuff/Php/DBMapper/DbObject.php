<?php


namespace TStuff\Php\DBMapper   {
    use TStuff\Php\Transform as T;
    class DbObject  {
         
        protected $tableName;

        /**
         * Returns an Metadata Array of the child class
         *
         * @return array
         */
        public function getMetadata():array{
            $meta = array();
            $reflection = new \ReflectionClass(get_class($this));
            $result = array();
            $result["class_name"] = $reflection->getShortName();
            $result["table_name"] = T\TextTransform::CamelCaseToSnakeCase($result["class_name"]);
            $result["namespace"] = $reflection->getNamespaceName();
            $result["parent"] = $reflection->getParentClass()->getName();
            $docData = T\PhpDocParser::getDocAsArray(get_class($this));
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

        /**
         * Undocumented function
         *
         * @param int $id
         * @return DbObject
         */
        public function single(int $id):DbObject{
            return null;
        }

        /**
         * Undocumented function
         *
         * @param string $query
         * @return DbObject
         */
        public function first(string $query):DbObject{
            return null;
        }

        /**
         * Undocumented function
         *
         * @param string $query
         * @return DbObject[]
         */
        public function query(string $query):array{
            return [];
        }

    }
}