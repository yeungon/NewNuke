<?php
declare(strict_types=1);
namespace app\controllers;
use app\core\Controller;
/**
* HomeController
*/
class HomeController extends Controller
{
	
	function __construct()
	{
		print "hello từ Home Controller";
	}

	public function index()
	{
		
		//$this->redirect("http://google.com");
		echo "Đây là index Controller Home Controller";
		//$this->render('index');
	}


	public function hello()
	{
		
		//$this->redirect("http://google.com");
		echo "Đây là hàm hello Controller Home Controller";
		//$this->render('index');
	}
}