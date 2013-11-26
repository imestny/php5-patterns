<?php

namespace phpDesignPatterns\Singleton;

abstract class Singleton
{
    /**
    * Храним список объектов в массиве, ключ - имя класса
    *
    * @var array
    */
    private static $instances = [];

    /**
    * Запрещаем прямую инициализацию
    */
    private function __construct()
    {
        
    }

    /**
    * Получаем экземпляр объекта
    *
    * @return mixed
    */
    final public static function getInstance()
    {
        $classname = get_called_class();
        
        if (! isset(self::$instances[$classname])) {
            self::$instances[$classname] = new static();
        }
        
        return self::$instances[$classname];
    }

    /**
    * Запрещаем клонирование
    *
    * @throws \RuntimeException
    */
    final public function __clone()
    {
        throw new \RuntimeException('Клинирование запрещено для класса ' . get_class($this));
    }

    /**
    * Запрещаем десериализацию
    *
    * @throws \RuntimeException
    */
    final public function __wakeup()
    {
        throw new \RuntimeException('Десериализация запрещена для ' . get_class($this));
    }
}

/**
* Класс Sun должен иметь всегда один экземпляр
*/
class Sun extends Singleton
{
    /**
    * Храним случайное число
    *
    * @var int
    */
    private $random = 0;
    
    /**
    * Генерирует случайное число от 10 до 20 только один раз
    *
    * @return int
    */
    public function getRandomInt()
    {
        if ($this->random == 0) {
            $this->random = rand(10, 20);
        }
        
        return $this->random;
    }
}

/**
* Класс Moon должен иметь всегда один экземпляр
*/
class Moon extends Singleton
{
    /**
    * Храним случайное число
    *
    * @var int
    */
    private $random = 0;
    
    /**
    * Генерирует случайное число от 1 до 10 только один раз
    *
    * @return int
    */
    public function getRandomInt()
    {
        if ($this->random == 0) {
            $this->random = rand(1, 10);
        }
        
        return $this->random;
    }
}

/**
 * Инициализируем и убиваем объект Sun пару раз - и видим, что случайное число осталось прежним.
 * Следовательно имеем дело с единственной копией объекта.
 */
$sun = Sun::getInstance();
var_dump($sun->getRandomInt());

unset($sun);

$sun = Sun::getInstance();
var_dump($sun->getRandomInt());


/**
 * Проведем аналогичные тесты для класса Moon
 */

$moon = Moon::getInstance();
var_dump($moon->getRandomInt());

unset($moon);

$moon = Moon::getInstance();
var_dump($moon->getRandomInt());

?>