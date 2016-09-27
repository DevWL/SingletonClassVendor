<?php
namespace wl;


/**
 * @dosc allows only one instance for each extending class
 * @example use it for database connection, config setup...
 * Be aware, singleton pattern is consider to be an antipatern and becaouse of it build it is hard to debug.
 * In most cases you do not need to use singleton patern so make a longer though about it befor you use it.
 */
class Singleton
{
    /**
     *  holds an single instance of a class
     *
     *  @var array of objects
     */
    protected static $instance = [];

    /**
     *  @desc provides a single slot to hold an instance interchanble between all child classes.
     *  @return object
     */
    public static function getInstance(){
        $class = get_called_class();
        if(!isset(self::$instance[$class]) || !self::$instance[$class] instanceof $class){
            self::$instance[$class] = new static(); // create and instance of child class which extends Singleton super class
            echo "new ". $class . PHP_EOL; // remove this line after testing
            return  self::$instance[$class]; // remove this line after testing
        }
        echo "old ". $class . PHP_EOL; // remove this line after testing
        return static::$instance[$class];
    }

    /**
     *  do not allow create new instance by new keyword
     * 
     */
    protected function __construct(){}

    /**
     *  Do not clone the object
     */
    protected function __clone(){}

    /**
     *  Do not allow reserialization of this object
     */
    protected function __wakeup(){}

}

/**
 * ----------------------------------------------USE EXAMPLE---------------------------------------------------
 *  @docs example database class by extending singleton class implements singleton pattern
 */
class Database extends Singleton
{
    public function __construct(){

    }
}


/**
 *  @docs Config class by extending singleton class implements singleton pattern
 */
class Config extends Singleton
{
    public function __construct(){

    }
}

/**
 *  @example create new Database
 */
$bd1 = Database::getInstance(); // new
$bd2 = Database::getInstance(); // old

/**
 *  @example create new Config 
 */
$bd1 = Config::getInstance(); // new
$bd2 = Config::getInstance(); // old



$bd3 = Config::getInstance(); // old
$bd4 = Database::getInstance(); // old

$bd5 = Database::getInstance(); // old
$bd6 = Config::getInstance(); // old