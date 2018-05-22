<?php
declare(strict_types=1);
//namespace App\Core;
require(__DIR__.'/Autoload.php');  
//require_once(__DIR__.'/Router.php');
/**
* if you dont want to automatically load the file using composer, then try require (file) as follows :-)
*/
//require_once(__DIR__.'/../controllers/HomeController.php');
//use app\core\Router;

use app\core\Registry;
/**
* App 
* The core system
*/
class App
{
	private $router;
	private static $config;
	private static $controller;
	private static $action;

	function __construct()
	{
		/**
		* When you create a new object retrieved from another namepace WITHIN another namespace, 
		* you have to use \ before, such as \app in this case
		*/
		/*sẽ được khởi tạo từ trong Router.php*/
		//new \app\controllers\HomeController;


		/*automatically trigger the autoload setup at app\core\Autoload.php*/
		new \Autoload(self::$config['rootDir']);

		$this->router = new Router(self::$config['basePath']);

		$registry_config = Registry::getInstance()->config = "Thử config";

		echo $registry_config;

		 //echo \Registry::getInstance()->ten;
		//$a->name = "Vuong";
		//echo $a->name;

		//$registry_config = \Registry::getInstance();

		//echo $registry_config;
	}

	/**
	* Set and get config
	* Both proptery and method are static, access by self:: or static:: or className::
	* @param $config 
	* @return configuration retrieved from config/main.php 
	*/
	public static function setConfig($config)
	{
		self::$config = $config;
	}

	public static function getConfig()
	{
		return self::$config;
	}

	public static function setController($controller)
	{
		self::$controller = $controller;
	}

	public static function getController()
	{
		return self::$controller;
	}

	public static function setAction($action)
	{
		self::$action = $action;
	}

	public static function getAction()
	{
		return self::$action;
	}


	public function dispatch()
	{
		//trigger the run() function from Router.php
		$this->router->run();
	}

}
