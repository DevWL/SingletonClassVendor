SingletonClassVendor abstract class provides a valid singleton pattern behaviour for the classes that extends from it.
Like every singleton pattern it will force some limitation regarding constructor accesibility.
This specific architecture force childern __constructor method to be set to protected.

```
<?php
namespace wl;


/**
 * @author DevWL
 * @dosc allows only one instance for each extending class.
 * it acts a litle bit as registry from the SingletonClassVendor abstract class point of view
 * but it provides a valid singleton behaviour for its children classes
 * Be aware, the singleton pattern is consider to be an anti-pattern
 * mostly because it can be hard to debug and it comes with some limitations.
 * In most cases you do not need to use singleton pattern
 * so take a longer moment to think about it before you use it.
 */
abstract class SingletonClassVendor
{
    /**
     *  holds an single instance of the child class
     *
     *  @var array of objects
     */
    protected static $instance = [];

    /**
     *  @desc provides a single slot to hold an instance interchanble between all child classes.
     *  @return object
     */
    public static final function getInstance(){
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
```

EXAMPLE

```
/**
 *  @example 1 - Database class by extending SingletonClassVendor abstract class becomes fully functional singleton
 *  __constructor must be set to protected becaouse: 
 *   1 to allow instansiation from parent class 
 *   2 to prevent direct instanciation of object with "new" keword.
 *   3 to meet requierments of SingletonClassVendor abstract class
 */
class Database extends SingletonClassVendor
{
    public $type = "SomeClass";
    protected function __construct(){
        echo "DDDDDDDDD". PHP_EOL; // remove this line after testing
    }
}


/**
 *  @example 2 - Config ...
 */
class Config extends SingletonClassVendor
{
    public $name = "Config";
    protected function __construct(){
        echo "CCCCCCCCCC" . PHP_EOL; // remove this line after testing
    }
}

```

TESTING

```
$bd1 = Database::getInstance(); // new
$bd2 = Database::getInstance(); // old
$bd3 = Config::getInstance(); // new
$bd4 = Config::getInstance(); // old
$bd5 = Config::getInstance(); // old
$bd6 = Database::getInstance(); // old
$bd7 = Database::getInstance(); // old
$bd8 = Config::getInstance(); // old

echo PHP_EOL."COMPARE ALL DATABASE INSTANCES".PHP_EOL;
var_dump($bd1);
echo '$bd1 === $bd2' . ($bd1 === $bd2)? ' TRUE' . PHP_EOL: ' FALSE' . PHP_EOL; // TRUE
echo '$bd2 === $bd6' . ($bd2 === $bd6)? ' TRUE' . PHP_EOL: ' FALSE' . PHP_EOL; // TRUE
echo '$bd6 === $bd7' . ($bd6 === $bd7)? ' TRUE' . PHP_EOL: ' FALSE' . PHP_EOL; // TRUE

echo PHP_EOL;

echo PHP_EOL."COMPARE ALL CONFIG INSTANCES". PHP_EOL;
var_dump($bd3);
echo '$bd3 === $bd4' . ($bd3 === $bd4)? ' TRUE' . PHP_EOL: ' FALSE' . PHP_EOL; // TRUE
echo '$bd4 === $bd5' . ($bd4 === $bd5)? ' TRUE' . PHP_EOL: ' FALSE' . PHP_EOL; // TRUE
echo '$bd5 === $bd8' . ($bd5 === $bd8)? ' TRUE' . PHP_EOL: ' FALSE' . PHP_EOL; // TRUE

```