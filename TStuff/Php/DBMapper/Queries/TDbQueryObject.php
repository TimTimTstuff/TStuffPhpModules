<?php
namespace TStuff\Php\DBMapper\Queries  ; 

    class TDbQueryObject  {
        /**
         * Table name for operation
         *
         * @var string
         */     
        public $table;
        /**
         * where condition
         *
         * @var string
         */
        public $where;
        /**
         * Array of Field / Table column names
         *
         * @var array
         */
        public $fields;
        /**
         * Values list for Insert command
         * Assoc Array
         *
         * @var array
         */
        public $field_values_insert;
        /**
         * specific field / column
         *
         * @var string
         */
        public $field;
        /**
         * offset / limit
         *
         * @var int
         */
        public $offset;
        /**
         * count / limit
         *
         * @var int
         */
        public $count;
        /**
         * values for update
         *
         * @var array
         */
        public $values;
    }