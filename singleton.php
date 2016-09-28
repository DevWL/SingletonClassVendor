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
     * Make constructor private, so nobody can call "new Class".
     */
    private function __construct() {}

    /**
     * Make clone magic method private, so nobody can clone instance.
     */
    private function __clone() {}

    /**
     * Make sleep magic method private, so nobody can serialize instance.
     */
    private function __sleep() {}

    /**
     * Make wakeup magic method private, so nobody can unserialize instance.
     */
    private function __wakeup() {}

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
$bd3 = Config::getInstance(); // new
$bd4 = Config::getInstance(); // old



$bd5 = Config::getInstance(); // old
$bd6 = Database::getInstance(); // old

$bd7 = Database::getInstance(); // old
$bd8 = Config::getInstance(); // old

echo get_class($bd1);
echo get_class($bd2);
echo get_class($bd3);
echo get_class($bd4);
echo get_class($bd5);
echo get_class($bd6);
echo get_class($bd7);
echo get_class($bd8);