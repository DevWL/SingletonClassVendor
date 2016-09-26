<?php
namespace sin;


/**
 * @docs allows only one instance of a class
 * @emaiple use it for database connection
 * @config file
 */
class Singleton
{
    /**
     *  holds an single instance of a class
     *
     *  @var boolean|object
     */
    private static $instance = false;

    /**
     *  public constructor
     *  init the class
     * 
     *  @return object
     */
    public function __construct(){
        if(self::$instance == false){
            echo "new". PHP_EOL;
           ;
            self::$instance = $this;
            return  self::$instance;
        }
        return static::getInstance();
    }

    /**
     *  private method
     *  returns instance of a class
     *
     *  @return object
     */
    private static function getInstance(){
        echo "old". PHP_EOL;
        return self::$instance;
    }

}

/**
 *  @example use example
 */
$ob1 = new Singleton(); // new
$ob2 = new Singleton(); // old

