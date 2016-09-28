<?php
namespace wl;


/**
 * @dosc allows only one instance for each extending class.
 * it acts a litle bit as registry from the Singleton abstract class point of view
 * but it provides a valid singleton behaviour for its children classes (extended)
 * @example use it for database connection, config setup...
 * Be aware, the singleton pattern is consider to be an anti-pattern
 * because it can be hard to debug.
 * In most cases you do not need to use singleton pattern
 * so take a longer moment to think about it before you use it.
 */
abstract class Singleton
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
        $class = get_called_class(); // or get_class(new static());
        if(!isset(self::$instance[$class]) || !self::$instance[$class] instanceof $class){
            self::$instance[$class] = new static(); // create and instance of child class which extends Singleton super class
            echo "new ". $class . PHP_EOL; // remove this line after testing
            return  self::$instance[$class]; // remove this line after testing
        }
        echo "old ". $class . PHP_EOL; // remove this line after testing
        return static::$instance[$class];
    }

    /**
     * Make constructor abstract to force protected implementation of the __constructor() method, so that nobody can call directly "new Class()".
     */
    abstract protected function __construct();

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
 * ---------------------------------------------- USE EXAMPLE BELLOW---------------------------------------------------
 */

/**
 *  @docs Config class by extending Singleton abstract class implements singleton pattern
 *  __constructor must be set to protected for two reasons: 
 *   1 to allow instansiation from parent class 
 *   2 to prevent direct instanciation of object with "new" keword.
 */
class Database extends Singleton
{
    protected function __construct(){
        echo "DDDDDDDDD". PHP_EOL; // remove this line after testing
    }
}


/**
 *  @docs Config class by extending Singleton abstract class implements singleton pattern
 *  __constructor must be set to protected for two reasons: 
 *   1 to allow instansiation from parent class 
 *   2 to prevent direct instanciation of object with "new" keword.
 */
class Config extends Singleton
{
    protected function __construct(){
        echo "CCCCCCCCCC" . PHP_EOL; // remove this line after testing
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


/**
 *  @example more testing
 */
$bd5 = Config::getInstance(); // old
$bd6 = Database::getInstance(); // old

$bd7 = Database::getInstance(); // old
$bd8 = Config::getInstance(); // old


echo PHP_EOL. PHP_EOL;
echo get_class($bd1)  . PHP_EOL;
echo get_class($bd2)  . PHP_EOL;
echo get_class($bd3)  . PHP_EOL;
echo get_class($bd4)  . PHP_EOL;
echo get_class($bd5)  . PHP_EOL;
echo get_class($bd6)  . PHP_EOL;
echo get_class($bd7)  . PHP_EOL;
echo get_class($bd8)  . PHP_EOL;