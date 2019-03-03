<?php
namespace TStuff\Php\Logging\DefaultLogger  ;

use TStuff\Php\Logging\ITLogger;
use TStuff\Php\DBMapper\TDBMapper;
use TStuff\Php\Logging\LogLevel;
 

    class DBLogger implements ITLogger {

        private $path;
        private $fileNameTemplate ="log_{date}.log";
        private $currentFileName = "";
        private $cat = "default";
        private $curr = "default";
        

        public function __construct(TDBMapper $mapper)
        {
            if($mapper == null)throw new \Exception("TDBMapper is Required");
            $mapper->registerObject("TStuff\Php\Logging\DefaultLogger\TLog");
       
        }

        private function writeLog($data){
            TLog::create($data);
        }

       
        public  function log(int $level, string $message,   $trace = null, string $category = null){
            $record = new TLog();
            $record->message = $message;
            $record->trace = json_encode($trace);
            $record->level = $level;
            $record->category = $category;
            $this->writeLog($record);
        }
        public  function setCategory(string $category){
            $this->curr = $category;
        }
      
        public  function clearCategory(){
            $this->curr = $this->cat;
        }
       
        public  function setDefaultCategory(string $category){
            $this->cat = $category;
        }

        public  function trace(string $message, $trace = null, string $category = null){
            $this->log(LogLevel::Trace,$message,$trace,$category);
        }
        public  function debug(string $message, $trace = null, string $category = null){
            $this->log(LogLevel::Debug,$message,$trace,$category);
        }
        public  function info(string $message, $trace = null, string $category = null)
        {
            $this->log(LogLevel::Info,$message,$trace,$category);
        }
        public  function warn(string $message, $trace = null, string $category = null){
            $this->log(LogLevel::Warning,$message,$trace,$category);
        }
        public  function error(string $message, $trace = null, string $category = null){
            $this->log(LogLevel::Error,$message,$trace,$category);
        }
        public  function fatal(string $message, $trace = null, string $category = null){
            $this->log(LogLevel::Fatal,$message,$trace,$category);
        }

}