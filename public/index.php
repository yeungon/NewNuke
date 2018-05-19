<?php
	declare(strict_types=1);

	require(__DIR__.'/../app/core/App.php');

	
	/*Global variable*/	
	$config = require_once dirname(__DIR__) . '/./config/main.php';

	//print_r($config);


	App::setConfig($config);

	//print_r(App::getConfig($config));
	//print_r(app\core\VietPhp\App::getConfig());

	//echo "thư mục gốc", $config['rootPath'];
	
	/**
	* Initiate a new object
	* Setting up the auto load from composer "app\\core\\VietPhp\\": "app/core",
	*/
	$app  = new App;

	$app->dispatch();
	

		

	/*echo isset($_ENV["abc"])? $_ENV["abc"]: "";

	echo "<pre>";
	print_r($_ENV);
*/
	



/*
echo isset($_SERVER['PATH_INFO'])? "Link bạn đang truy cập: ".$_SERVER['PATH_INFO']: "";




*/

/*if($_SERVER['QUERY_STRING']!== NULL){

		$url = $_SERVER['QUERY_STRING'];

		$url = explode("/", $url);

		list($a, $b) = $url;

		echo $a, $b;

		print_r($url);
}
*/

//echo "Thời gian load", memory_get_usage();


