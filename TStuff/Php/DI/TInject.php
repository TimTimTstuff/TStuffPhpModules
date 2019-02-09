<?php



namespace TStuff\Php\DI {

    use \ReflectionClass;

    class TInject
    {

        /**
         * Holds service references
         *
         * @var TInjectType[]
         */
        private $services = array();

        /**
         * returns the requested Service
         *
         * @param string $name
         * @return void
         */
        public function getService(string $name)
        {
            if ($this->services[$name]->type == TInjectTypes::AlwaysNew
                && is_callable($this->services[$name]->service)) {
                return $this->services[$name]->service($this);
            }

            return $this->services[$name]->service;

        }

        /**
         * Register a new Service
         *
         * @param string $name : name to retrieve a specific service
         * @param callable|mixed $service object or anonymous function to create a service object. The Function needs the parameter of type TInject 
         * @param integer $registerType defines register type from TInjectTypes (1: MultiUse, 2: AlwaysNew )
         * @return void
         */
        public function RegisterService(string $name, $service, int $registerType = TInjectTypes::MultiUse) : void
        {
       
        //Create an object to store information about the Service
            $tInjectType = new TInjectType();
            $tInjectType->name = $name;
            $tInjectType->type = $registerType;
        
        //Register the Service based of its type
            $type = gettype($service);
            if ($type == "object" && is_callable($service)) {
            //if its a object and callable, check if it is MultiUse (create the object once and store it)
                if ($tInjectType->type == TInjectTypes::MultiUse) {
                    $tInjectType->service = $service($this);
                } else {
                //or store only the reference to the anonymous function
                    $tInjectType->service = $service;
                }

            } else {
            //store just the object
                $tInjectType->service = $service;
            }

            $this->services[$tInjectType->name] = $tInjectType;
        }

        /**
         * Instantiates a new object with dependencies 
         *
         * @param string $className
         * @return object Returns a object of $className
         */
        public function Instantiate(string $className) : object
        {
            $refObject = new ReflectionClass($className);
            $reflectionParam = $refObject->getConstructor()->getParameters();
            $args = array();
            foreach ($reflectionParam as $p) {
                if ($this->services[$p->name]->type == TInjectTypes::AlwaysNew
                    && is_callable($this->services[$p->name]->service)) {
                    $args[] = $this->services[$p->name]->service($this);
                } else {
                    $args[] = $this->services[$p->name]->service;
                }
            }
            return new $className(...$args);
        }
    }
}