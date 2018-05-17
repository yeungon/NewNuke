<?php
declare(strict_types=1);
namespace app\core\VietPhp;

//require_once(__DIR__.'/Router.php');
/**
* if you dont want to automatically load the file using composer, then try require (file) as follows :-)
*/
require_once(__DIR__.'/../controllers/HomeController.php');


use app\core\Router;
use app\controllers;
/**
* App 
* The core system
*/
class App
{
	private $router;

	public static $config;

	function __construct()
	{
		/**
		* When you create a new object retrieved from another namepace WITHIN another namespace, 
		* you have to use \ before, such as \app in this case
		*/
		/*sẽ được khởi tạo từ trong Router.php*/
		//new \app\controllers\HomeController;

		$this->router = new \app\core\Router\Router;
		
		$this->router->get('/{abc}/{cde}', 'HomeController@index');


		$this->router->get('/abc', function (){

			echo "nội dung từ trang abc";

		});



		$this->router->post('/test', function (){

			echo "đây là trang test";

		});

		$this->router->any('/post/{category}/{id}/{bac}', function ($arg1, $arg2, $arg3){

			echo "đây là trang post và có các paramater $arg1, và $arg2 và $arg3";

		});

		$this->router->any('/news/{abc}/{abc}', function ($arg1, $arg2){

			echo "đây là trang $arg1, và $arg2";

		});

		$this->router->any('/admin', function (){

			echo "Hello @admin đây là trang admin.";

		});

		/*catch lỗi*/;
		$this->router->any("*", function(){
			echo "400 not found";
		});

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

	public function run()
	{
		//hàm run() của Router.php
		$this->router->run();
	}

}
