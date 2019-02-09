<?php

namespace TestClass {


    class SessionHelper
    {
        private $sessionInfo;
        public function __construct(array $sessionObject)
        {
            $this->sessionInfo = $sessionObject;
        }

        public function setValue(string $key, $value) : void
        {
            $this->sessionInfo[$key] = $value;
        }

        public function getValue(string $key)
        {
            return $this->sessionInfo[$key] ?? null;
        }
    }

}