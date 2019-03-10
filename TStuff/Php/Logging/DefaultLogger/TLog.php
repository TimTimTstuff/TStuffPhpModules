<?php

namespace TStuff\Php\Logging\DefaultLogger  ;

use TStuff\Php\DBMapper\DbObject;
 

    class TLog extends DbObject {

        /**
             * Undocumented variable
             *
             * @var int
             * @DBMapper {"index":"primary","auto_increment":true}
             */
        public $logId;
        /**
         * Undocumented variable
         *
         * @var int
         */
        public $level;
        /**
         * Undocumented variable
         *
         * @var string
         * @DBMapper {"size":"1000"}
         */
        public $message;
        /**
         * Undocumented variable
         *
         * @var string
         * @DBMapper {"type":"TEXT"}
         */
        public $trace;

         /**
             * Undocumented variable
             *
             * @var timestamp
             * @DBMapper {"default":"CURRENT_TIMESTAMP"}
             */
        public $createdOn;
        /**
         * Undocumented variable
         *
         * @var string
         */
        public $category;
    }