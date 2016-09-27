<?php
namespace sin;


/**
 * @dosc allows only one instance of a class
 * @example use it for database connection
 */
class Singleton
{
    /**
     *  holds an single instance of a class
     *
     *  @var boolean|object
     */
    protected static $instance = false;

    /**
     *  protected method
     *  returns instance of a class for each extended class
     *
     *  @return object
     */
    public static function getInstance(){
        $class = get_called_class();
        if(!self::$instance instanceof $class){
            echo "new ". $class . PHP_EOL;
            // $class = __CLASS__;
            // self::$instance = new $class; // ??
            self::$instance = new static(); // returns old in extended class
            return  self::$instance; // this line can be skeeped but i left it for debug purpose only
        }
        echo "old ". $class . PHP_EOL;
        return static::$instance;
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
 *  @docs database class by extending singleton class implements singleton pattern
 */
class Database extends Singleton
{
    public function __construct(){

    }
}

/**
 *  @example create new Database class which implements singleton pattern from Singleton class 
 */
$bd1 = Database::getInstance(); // new
$bd2 = Database::getInstance(); // old


/**
 *  @docs Config class by extending singleton class implements singleton pattern
 */
class Config extends Singleton
{
    public function __construct(){

    }
}

/**
 *  @example create new Config class which implements singleton pattern from Singleton class 
 */
$bd1 = Config::getInstance(); // new
$bd2 = Config::getInstance(); // old