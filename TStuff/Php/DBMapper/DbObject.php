<?php


namespace TStuff\Php\DBMapper   {
    use TStuff\Php\Transform as T;
    use TestClass\DbUser;
  abstract class DbObject extends TDbObjectQueries  {
         
        protected $tableName;
        protected $data;
        
        public function __construct(?array $data = null){
            if($data != null){
                $this->data = $data;
              
            }
           
        }

        public function save(){
            
        }

        public function remove(){

        }

    
    }
}