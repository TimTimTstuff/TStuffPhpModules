<?php



namespace TStuff\Php\API   {

    /**
         * GET entity
         * GET entity id
         * POST entity data
         * PUT entity id data
         * DElETE entity id
         * POST action data
         */
        

   abstract class TApiController  {
    
        private $entity;
        private $response;
        private $internalRoute = [
            ["GET",[],["get"]],
            ["GET",["id"],"getId"],
            ["POST",["data"],"create"],
            ["PUT",["id","data"],"update"],
            ["DELETE",["id"],"delete"]
        ];

        public function __construct(string $entity){
            $this->entity = $entity;    
        }

        public function doRequest(string $method, ?int $id, ?array $data){
           $action = "";
           foreach ($this->internalRoute as $route) {
               if($method == $route[0]){

               }
           }
        }

        public abstract function get():void;
        public abstract function getId(int $id):void;
        public abstract function create(array $data):void;
        public abstract function update(int $id, array $data):void;
        public abstract function delete(int $id):void;
    }
}