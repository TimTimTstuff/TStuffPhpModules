<?php  
namespace TStuff\Php\Cache  ; 

    class TFileCache implements ITCache  {
        
        private $path;
        
        private $cacheData;

        private $categories = [];

        private static $fileExtension = ".cache";
        private static $fileNameDelimiter = "_";

        private static $self;

        private function __construct(string $cacheDirPath){
            $this->path = $cacheDirPath;
            if(!is_dir($this->path)){
                if(!mkdir($this->path)){
                    throw new \Exception("Can't find or create FileCache folder: $this->$path");
                }   
            }
        }

        public static function getInstance($cacheDirPath){
            if(self::$self == null){
                self::$self = new TFileCache($cacheDirPath);
            }
            return self::$self;
        }

        private static function generateCacheFileName($category){
            $fileNameParts = [$category,self::$fileNameDelimiter,time(),self::$fileExtension];
            return implode("",$fileNameParts);
        }

        private static function getCategoryFromFileName($fileName){
            return explode(self::$fileNameDelimiter,str_replace(self::$fileExtension,"",$fileName));
        }


        private function getAllCacheFiles(){
            $dirs = scandir($this->path);
            $nonCategories = array(".","..");
            $this->categories = [];
            foreach ($dirs as $key => $value) {
                
                if(in_array($value,$nonCategories))continue;
                {
                    $this->categories[self::getCategoryFromFileName($value)] = $value;
                }
            }
        }


        public function storeValue(string $category,string $key, mixed $value, int $lifetime){
            //check if category eg. file exists
            //get content
            //store value

        }

        public function getValue(string $category, string $key):mixed{
            //load or read category, and key
        }
        
        public function invalidate(string $category, ?string $key = null):void{

        }

        public function existsKey(string $category, string $key):bool{

        }
    }