<?php
/**
* Router
*/
declare(strict_types=1);
//namespace App\Core;



class Router
{
	/**
	* Array contains the routes
	* @var static array
	* @see https://www.youtube.com/watch?v=6reEBParHzQ
	*/
	private static $routers = [];
	
	/**
	* @var string containning the basePath
	*/
	private $basePath;

	function __construct($basePath)
	{
		$this->basePath = $basePath;
	}

	/**
	* @param void
	* @return REQUEST_URI from the gobal constant $_REQUEST. 
	* "/" if isset is NULL
	*/
	private function getRequestURL()
	{
		
		$url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI']: '/';

		
				
		/*remove the initial part of the url*/
		$url = str_replace($this->basePath, '', $url);
		
		/**
		* Remove the slash "/" in the right, then /abc/ ==> /abc
		* @see https://3v4l.org/7jhrv
		*/
			
		$url = $url[-1] === "/"? substr($url, 0, -1): $url; 
		
		
		/** 
		* Check the url 
		* If empty => return '/' ORTHERWISE, RETURN $url
		*/
				
		$url = $url === '' || empty($url)? '/': $url;

		return $url;

	}
	
	/**
	*@param void
	*@return REQUEST_METHOD provided by global magic CONSTANT $_REQUEST
	*/
	private function getRequestMethod()
	{
		$method = $url = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD']: 'GET';

		return $method;

	}
	
	private static function addRoute($method, $url, $action)
	{
		self::$routers[] = [$method, $url, $action];
	}

	public static function get($url, $action)
	{
		self::addRoute('GET', $url, $action);
	}

	public static function post($url, $action)
	{
		self::addRoute('POST', $url, $action);	
	}

	public static function any($url, $action)
	{
		self::addRoute('GET|POST', $url, $action);

	}

	public function match()
	{
			$checkRoute = false;
			$params 	= [];

			$requestURL = $this->getRequestURL();
			$requestMethod = $this->getRequestMethod();

			$routers = self::$routers;
			
			foreach ($routers as $route){
				[$method, $url, $action] = $route;

				if (strpos($method, $requestMethod) === FALSE ){
					continue;
				}

				if ( $url === '*' ){
					$checkRoute = true;
				} elseif (strpos($url, '{') === FALSE ){
					if (strcmp(strtolower($url), strtolower($requestURL)) === 0 ){
						$checkRoute = true;
					} else {
						continue;
					}
				} elseif (strpos($url, '}') === FALSE ){
					continue;
				} else {
						$routeParams 	= explode('/', $url);
						$requestParams 	= explode('/', $requestURL);
						if (count($routeParams) !== count($requestParams) ){
						continue;
					}

					foreach ($routeParams as $k => $rp ){
						if (preg_match('/^{\w+}$/',$rp) ){
							$params[] = $requestParams[$k];
						}
					}
					
					$checkRoute = true;
				}

				if ($checkRoute === true ){
					if (is_callable($action) ){
						call_user_func_array($action, $params);
					} elseif (is_string($action)){
						$this->compileRoute($action,$params);
					}
					return;
				} else {
					continue;
				}
			}
			return;
		}
	
	private function compileRoute($action, $params){

		/*split the string HomeController@index*/
		if(count(explode("@", $action)) !== 2){

			die("There are some error when configuring router");
		}

		$className = explode('@', $action)[0];
		$methodName = explode('@', $action)[1];
		$classnamespace = 'app\\controllers\\'.$className; 

		if (class_exists($classnamespace)) {
			/**then class exists, then create a new object*/

			$object = new $classnamespace;

			if (method_exists($classnamespace, $methodName)){
				/*call the method using the $params*/
				call_user_func_array([$object, $methodName], $params);
			}else{

				die("Method $methodName not found");
			}

			
		}else{

			die("Class $classnamespace not found");
		}


	}

	public function run()
	{
		//$url = $this->getRequestURL();

		//echo $url;

		//$method = $this->getRequestMethod();
		/*echo $method;

		echo "<pre>";
		print_r($this->routers);*/

		$this->match();
	}
}


?>