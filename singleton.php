<?php
namespace sin;



class Singleton
{

    private static $instance = false;

    public function __construct(){
        echo "Class created";
        print_r($this);
    }

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
// $ob2 = new Singleton();
// $ob3 = new Singleton();

