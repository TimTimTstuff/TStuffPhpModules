<?php


namespace TStuff\Php\API   {

    class TApi  {

        /**
         * Undocumented variable
         *
         * @var TApiController[]
         */
        private $apiController = [];


        private $charset = "UTF-8";
        private $maxAge = 3600;
      
        private $data;

        public function __construct(){
            $this->setHeader("GET",$this->charset,$this->maxAge);
            
        }

        private function setHeader(string $method, string $charset, int $maxAge){
            header("Access-Control-Allow-Origin: *");
            header("Content-Type: application/json; charset=".$charset);
            header("Access-Control-Allow-Methods: ".$method);
            header("Access-Control-Max-Age: ".$maxAge);
            header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        }

        private function readJsonContent(){
            $this->data = json_decode(file_get_contents("php://input"));
        }


    }
}