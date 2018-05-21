<?php
declare(strict_types=1);


class Autoload{
		/**
		* @var string
		* @see https://www.youtube.com/watch?v=9jcVMF-i7ss&list=PL4m3Y7pzfrGmG7DEQ4lBaIW8mE6oivnCS&index=9
		*/
		private $rootDir;

		function __construct($rootDir){
			$this->rootDir = $rootDir;

			/**
			* @param $this refers to THIS class
			* @param "autoload" is the function that will load the class
			*/
			spl_autoload_register([$this,'autoLoad']);

			/*automatically load the file*/
			$this->autoLoadFile();
		}

		/**
		* Load the class
		* @param classname
		*/
		private function autoLoad($class){

			$fileName = explode('\\', $class);

			$fileName = end($fileName);
			$filePath = $this->rootDir.'\\'.strtolower(str_replace($fileName, '', $class)).$fileName.'.php';

			if (file_exists($filePath)){
				require_once ($filePath);
			}
			else{
				//throw new AppException("$class does not exsits")
				die("Call $class does not exit");
				//echo "lỗi rồi";
			}
				
		}

		/**
		* Load the the file
		* @param void
		*/
		private function autoLoadFile(){
			foreach ($this->defaultlFileLoad() as $file){
				require_once ($this->rootDir .'/'.$file);
			}
		}

		/**
		* Which file is loaded
		* @param void
		*/
		private function defaultlFileLoad(){
			return [
				'app/core/Router.php',
				'app/routers.php'
			];
		}
	}


/*
class Autoloadabc{

	function __construct(){

		spl_autoload_register();
	}
}
*/

/**
	* Autoload
	* @see https://kipalog.com/posts/PHP-co-the-ban-chua-biet----Auloading
	* @author Như các bạn thấy thì, toàn bộ các namespace của mình trong code ví dụ đều có prefix là App\\ và nằm trong folder app/. Trong function 
	* my_app_autoloader sẽ nhận vào tên đầy đủ của class cần được load ví dụ App\Controllers\PostController, mình tiến hành bỏ đi prefix chỉ giữ 
	* lại phần phía sau, mình sẽ được một chuỗi là Controllers\PostController đây là chuỗi tương đương với tên một folder và tên file. Mình tiến 
	* hành thanh thế dấu ngăn cách namespace \ thành dấu ngăn cách folder DIRECTORY_SEPARATOR và nối thêm định dạng file (.php). Việc còn lại chỉ 
	* là kiểm tra đường dẫn Controllers/PostController.php có trong folder app/ không và dùng lệnh require_once để load file lên.
	*/
/*	function vietphpAutoload($class){

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

	spl_autoload_register("vietphpAutoload");*/