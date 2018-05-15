<?php
require_once(dirname(__FILE__).'/Router.php');
/**
* App 
* The core system
*/
class App
{
	private $router;

	function __construct()
	{
		$this->router = new Router;
		$this->router->get('/', function (){

			echo "đây là trang home";

		});

		$this->router->get('/test', function (){

			echo "đây là trang test";

		});

		$this->router->post('/post', function (){

			echo "đây là trang post";

		});


	}
	public function run()
	{
		//hàm run() của Router.php
		$this->router->run();
	}

}
