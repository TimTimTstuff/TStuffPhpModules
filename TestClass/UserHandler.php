<?php

namespace TestClass {
    
    class UserHandler
    {
        private $user;
        public function __construct(User $user, PrintMessage $msg)
        {
            $this->user = $user;
            $msg->print("User Handler created");
        }
    }

}