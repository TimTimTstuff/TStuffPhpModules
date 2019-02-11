<?php



namespace TStuff\Php\Transform   {

    class PhpDocParser  {

        public static function getDocAsArray(string $className){
            $reflector = new \ReflectionClass($className);
            $refParam = $reflector->getProperties();
            $result = array();
            foreach ($refParam as $value) {
                $doc = $value->getDocComment();
                $result[$value->name] = self::parseDocText($doc);
            }
            return $result;
        }

        private static function parseDocText(string $doc):array{
            $result = array();
            if (preg_match_all('/@(\w+)\s+(.*)\r?\n/m', $doc, $matches)){
                $result = array_combine($matches[1], $matches[2]);
            }
            return $result;
        }

    }
}