<?php
namespace TestClass
{
    class User
    {
        public $name;
        public $id;
        public function __construct(string $name, int $id)
        {
            $this->name = $name;
            $this->id = $id;
        }
    }
}