<?php

namespace TestClass   {

    use TStuff\Php\DBMapper\DbObject;


    class TstuffPasswords extends DbObject  {

        /**
         * Undocumented variable
         *
         * @var int
         * @DBMapper {"index":"primary"}
         */
        public $id;

        /**
         * Undocumented variable
         *
         * @var string
         * @DBMapper {}
         */
        public $password;

        /**
         * Undocumented variable
         *
         * @var string
         */
        public $target;

        /**
         * Undocumented variable
         *
         * @var int
         */
        public $type;
        
        /**
         * Undocumented variable
         *
         * @var timestamp
         * @DBMapper {"default":"CURRENT_TIMESTAMP"}
         */
        public $createdOn;

    }
}