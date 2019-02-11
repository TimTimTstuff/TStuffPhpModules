<?php




namespace TestClass   {

    use TStuff\Php\DBMapper\DbObject;

    class DbProducts extends DbObject  {

        /**
         * Undocumented variable
         *
         * @var int
         * @DBMapper {"index":"primary"}
         */
        public $productId;
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
         * @DBMapper {"type":"text"}
         */
        public $description;
        /**
         * Undocumented variable
         *
         * @var float
         */
        public $price;
        /**
         * Undocumented variable
         *
         * @var float
         */
        public $tax;
        /**
         * Undocumented variable
         *
         * @var int
         */
        public $inStock;
        /**
         * 
         *
         * @var int
         */
        public $soldAmount;
        /**
         * Undocumented variable
         *
         * @var int
         */
        public $ownerUserId;
    }
}