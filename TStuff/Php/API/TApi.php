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
        private $response;

        public function __construct(){
           
            $this->readJsonContent();
           $this->response = array("RequestType"=>$_SERVER["REQUEST_METHOD"],"content"=>$this->data,"POST"=>$_POST,"GET"=>$_GET); 
           //get parameter entity, id, filter
           //?entity=product&id=1,&filter=null
           //?action=xyz (allways post)
            
        }

        public function getResponseAsString(){
            echo json_encode($this->response);
        }

        private function setHeader(string $method, string $charset, int $maxAge){
            header("Access-Control-Allow-Origin: *");
            header("Content-Type: application/json; charset=".$charset);
            
            header("Access-Control-Max-Age: ".$maxAge);
            header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        }

        private function readJsonContent(){
            $x =  json_decode(file_get_contents("php://input"));
            $this->data = $x;
        }

        

    }
}