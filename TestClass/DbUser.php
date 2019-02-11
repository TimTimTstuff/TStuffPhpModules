<?php 

namespace TestClass   {

    use TStuff\Php\DBMapper\DbObject;

        class DbUser extends DbObject {
            /**
             * Undocumented variable
             *
             * @var int
             * @DBMapper {"index":"primary","auto_increment":true}
             */
            public $id;
            /**
             * Undocumented variable
             *
             * @var string
             * @DBMapper {"size":100,"index":"unique"}
             */
            public $name;
            /**
             * Undocumented variable
             *
             * @var string
             */
            public $password;
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
             * @var timestamp
             */
            public $lastLogin;
    
            /**
             * Undocumented variable
             *
             * @var bool
             */
            public $isAdmin;

        }
    }