<?php
declare(strict_types=1);
namespace app\controllers;
use app\core\Controller;
use \App;
/**
* HomeController
*/
class HomeController extends Controller
{
	
	function __construct()
	{
		/**
		* Using the __construct from the core\Controller;
		* parent::__construct() overrides the __construct() 
		* in the extended 
		* HomeController
		*/
		parent::__construct();
	}

	public function index()
	{
		
		$this->render('index', [

			"a" => "Vượng",
			"b" => "Nguyễn",
		]);
		
	}


	public function hello()
	{
		
		//$this->redirect("http://google.com");
		echo "Đây là hàm hello Controller Home Controller";
		//$this->render('index');
	}
}