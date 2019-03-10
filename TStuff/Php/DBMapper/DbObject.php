<?php

/**
 * @todo Have done a big mistake, the parent class references the child class, have to fix that somehow, works now, is bad.. 
 */

namespace TStuff\Php\DBMapper;
    use TStuff\Php\Transform as T;
    use TestClass\DbUser;
    use TStuff\Php\DBMapper\Queries\TDbObjectQueries;

    abstract class DbObject extends TDbObjectQueries
    {
        protected $data;
        protected $primaryFieldName;
        protected $primaryValue;
    
        public function __construct(? array $data = null)
        {
            if ($data != null) {
                $this->data = $data;
             
                foreach ($this->data as $key => $value) {  
                   
                    if($this->getPrimaryFieldName() == $key){
                        
                        $this->primaryValue = $value;
                        continue;
                    }
                    $fName = T\TextTransform::SnakeCaseToCamelCase($key);
                    
                  
                    $this->$fName = $value;

                }

            } else {
                $fields = self::getMetadata()["field_meta"];
                 $data = [];
                foreach ($fields as $key => $value) {
                    $data[$value['field_name']] = null;
                    if (($value['index'] ?? "none") == "primary") {
                        $this->primaryFieldName = $value['field_name'];
                        $this->primaryValue = null;
                    }
                }
            }

        }

        public function getPrimaryFieldName():?string{
            if($this->primaryFieldName == null){
                $meta = self::getMetadata();
                foreach ($meta["field_meta"] as $key => $value) {
                    if(($value['index']??"none") == "primary"){
                        $this->primaryFieldName = $value['field_name'];
                    }
                }
            }
            return $this->primaryFieldName;
        }

        public function getPrimaryFieldValue(){
            return $this->primaryValue;
        }

        /**
         * Undocumented function
         * @todo Refactor;
         * @return void
         */
        public function save()
        {
           $updateList = $this->getUpdateList();

            if($this->primaryValue == null){
                echo "create";
            }else{
                echo "update";
            }

            foreach ($updateList as $key => $value) {
                $this->data[$key] = $value[0];
            }
        }

        public function getUpdateList():array{
            $updateList = [];
            $isNew = $this->primaryFieldName == null;
            $fields = (array)$this;
            foreach ($fields as $key => $value) {
               
                if(strpos($key, chr(0))===false) {
                    $fieldName = T\TextTransform::CamelCaseToSnakeCase($key);

                    if(($fieldName != $this->primaryFieldName || $isNew) && $value !== $this->data[$fieldName]){
                        $updateList[$fieldName] = [$value, $this->data[$fieldName]];
                    }
                    
                }
            }
            return $updateList;
        }

        

    }
