<?php
class ObjectBroker{
  public static $stack=array();

  public static function register($key,$value){
    self::$stack[$key]=$value;
  }

  public function get($key){
    $object  = self::$stack[$key];
    if(!$object) 
      throw new Exception("Object not found", 1);
    return $object;
      
  }
}