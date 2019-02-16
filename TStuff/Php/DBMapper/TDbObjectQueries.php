<?php


namespace TStuff\Php\DBMapper;   

    interface TDbObjectQueries  {
        /**
         * Returns a single object or throws an Exception if no or multiple records are found
         *  Query example: "name = 'test' and age > 1"
         *  Query example 2:  "name = 'test' order by age"
         * @param string $query SQL Query without where 
         * @return DbObject
         */
        public static function single(string $query):DbObject;
        /**
         * Returns a single object or the default object
         *
         * @param string $query query to execute
         * @param DbObject|null $default default value to return
         * @return DbObject|null null or the found record
         */
        public static function singleOrDefault(string $query,?DbObject $default = null):?DbObject;
        /**
         * Returns the first element of the resultset. Throws an exception if no record is found
         *
         * @param string $query
         * @return DbObject|null
         */
        public static function first(string $query):?DbObject;
        /**
         * Returns the first record of the result or default if the result is empty
         *
         * @param string $query
         * @param DbObject|null $default
         * @return DbObject|null
         */
        public static function firstOrDefault(string $query,?DbObject $default = null):?DbObject;
        /**
         * Return all records by query
         *
         * @param string $query
         * @return array
         */
        public static function all(string $query):array;
        /**
         * deletes all given records
         *
         * @param array $objects
         * @return void
         */
        public static function delete(array $objects):void;
        /**
         * updates all given records
         *
         * @param array $objects
         * @return void
         */
        public static function update(array $objects):void;
        /**
         * deletes all records by query
         *
         * @param string $query
         * @return void
         */
        public static function deleteBy(string $query):void;
        /**
         * updates all records in query by fieldValueArray
         *
         * @param string $query
         * @param array $fieldValueArray assoc array of fields to update
         * @return void
         */
        public static function updateBy(string $query,array $fieldValueArray):void;

        /**
         * creates a new object
         *
         * @param DbObject $object
         * @return DbObject
         */
        public static function create(DbObject $object):DbObject;

        /**
         * creates a list of objects
         *
         * @param DBObject[] $objects
         * @return DbObject[]
         */
        public static function createAll(array $objects):array;
        
    }
