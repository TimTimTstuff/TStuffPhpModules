<?php   

    
    
    namespace TestClass   {
    
        class DbUser  {
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
             * @DBMapper {"default":"timestamp"}
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
             * @var string
             * @DBMapper {"type":"text"}
             */
            public $description;
            /**
             * Undocumented variable
             *
             * @var int
             */
            public $age;
            /**
             * Undocumented variable
             *
             * @var float
             *
             */
            public $currentMoney;
        }
    }