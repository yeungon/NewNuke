<?php
	declare(strict_types=1);

	//require(__DIR__.'/../app/core/App.php');  
	
	require_once dirname(__DIR__) . '/./vendor/autoload.php';
	
	/**
	* Initiate a new object
	* Setting up the auto load from composer "app\\core\\VietPhp\\": "app/core",
	*/
		
	$app  = new app\core\VietPhp\App;

	$app->run();

	/**
	* Autoload
	* @see https://kipalog.com/posts/PHP-co-the-ban-chua-biet----Auloading
	* @author Như các bạn thấy thì, toàn bộ các namespace của mình trong code ví dụ đều có prefix là App\\ và nằm trong folder app/. Trong function 
	* my_app_autoloader sẽ nhận vào tên đầy đủ của class cần được load ví dụ App\Controllers\PostController, mình tiến hành bỏ đi prefix chỉ giữ 
	* lại phần phía sau, mình sẽ được một chuỗi là Controllers\PostController đây là chuỗi tương đương với tên một folder và tên file. Mình tiến 
	* hành thanh thế dấu ngăn cách namespace \ thành dấu ngăn cách folder DIRECTORY_SEPARATOR và nối thêm định dạng file (.php). Việc còn lại chỉ 
	* là kiểm tra đường dẫn Controllers/PostController.php có trong folder app/ không và dùng lệnh require_once để load file lên.
	*/
	function vietphpAutoload($class){

		$root = 'app/';
	    $prefix = 'App\\';

	    // bỏ prefix
	    $classWithoutPrefix = preg_replace('/^' . preg_quote($prefix) . '/', '', $class);
	    // Thay thế \ thành /
	    $file = str_replace('\\', DIRECTORY_SEPARATOR, $classWithoutPrefix) . '.php';

	    $path = $root . $file;
	    if (file_exists($path)) {
	        require_once $path;
	    }
	}

	spl_autoload_register("vietphpAutoload");

		

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

