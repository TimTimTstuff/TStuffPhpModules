<?php
 namespace TestClass  ;

use TStuff\Php\DBMapper\DbObject;
 
 
     class DbIndexModel extends DbObject  {
        
        /**
         * Undocumented variable
         *
         * @var int
         * @DBMapper {"index":"primary"}
         */
        public $indexId;

        /**
         * Undocumented variable
         *
         * @var string
         * @DBMapper {"size":250, "index":"unique"}
         */
        public $moduleName;

        /**
         * Undocumented variable
         *
         * @var string
         * 
         */
        public $moduleDeveloper;
    }