<?php
/**
* Registry using Singleton design pattern && Registry design pattern
* Registry: manage all global variables
* @see https://www.youtube.com/watch?v=6f94vdhS3Hs&list=PL4m3Y7pzfrGmG7DEQ4lBaIW8mE6oivnCS&index=14
* @example https://3v4l.org/stN5G
*/
namespace core\app;
class Registry
{
	
	/* The object that will be self-initiated*/
	private static $instance;
	/*The $storage to storage the object*/
	private $storage;

	/** 
	* Set the __construct() to private to prevent initiate new object using new keyword such as "new Registry"
	*/
	private function __construct()
	{
		
	}

	/**
	* @param void
	* @return the instance
	*/
	public static function getInstance()
	{
		/*Initiating new and same object in global scope*/
		if(!isset(self::$instance)){
			self::$instance = new Registry;
			return self::$instance;
		}
	}
	/**
	* @param string $name and $value that will be used to set the values for the instance
	* @return the value of the instance
	*/
	public function __set($name, $value)
	{
		if(!isset($this->storage[$name])){
			$this->storage[$name] = $value;
		} else {
			
			die("Cannot create this instance. Unknown reason");
		}
	}

	public function __get($name)
	{
		if(isset($this->storage[$name])){
			return $this->storage[$name];
		} else {
			return null;
		}
	}

}

