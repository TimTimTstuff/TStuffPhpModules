<?php


namespace TStuff\Php\DBMapper {
    use TStuff\Php\Transform as T;
    use TestClass\DbUser;

    abstract class DbObject extends TDbObjectQueries
    {
        protected $data;
        protected $primaryFieldName;
        protected $primaryValue;
    
        public function __construct(? array $data = null)
        {
            if ($data != null) {
                $this->data = $data;
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

        /**
         * Undocumented function
         * @todo Refactor;
         * @return void
         */
        public function save()
        {
           $updateList = $this->getUpdateList();

            if($isNew){
                //insert
            }else{
                //update
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
}