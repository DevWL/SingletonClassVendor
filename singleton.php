<?php
namespace wl;


/*
*  Singleton pattern will allow to create only one instance of the class
*  call install method to get object
*/
class Singleton
{
    /**
     * holds single instance or false
     */
    private static $instance = false;

    /**
     *  constructor is private to prevent users to call new operator on a class to get its instance
     */
    private function __construct(){
        echo "Class created";
    }

    /*
    * creates only one instance of a Singlton class
    * @return instance of Singleton object
    */
    public static function getInstance(){
        if(self::$instance == false){
            $class = __CLASS__;
            echo "new<br />";
           ;
            self::$instance = new Singleton;
            return  self::$instance;
        }
        echo "old<br />";
        return self::$instance;
    }

}

$ob1 = Singleton::getInstance();
$ob2 = Singleton::getInstance();

