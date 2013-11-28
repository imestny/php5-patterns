<?php

namespace phpDesignPatterns\SimpleFactory;

class Factory
{
    /**
    * Храним список объектов в массиве, ключ - имя класса
    *
    * @var array
    */
    private static $instances = array();
    
        /**
        * Вместо автоматической инициализации объектов - можно поставить CASE условие
        * в котором будет ограниченное число классов и класс по умолчанию
        */
        public static function getInstance($className)
        {
            if (array_key_exists($className, self::$instances)) {
                    return self::$instances[$className];
            }
            
            return self::$instances[$className] = new $className();
        }
}

/**
 * Таким образом, инициализируем нужные объекты через одну метод.
 */
$hulk = Factory::getInstance('Hulk');
$thor = Factory::getInstance('Thor');


?>