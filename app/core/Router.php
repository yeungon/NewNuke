<?php
/**
* A simple class to handle rounting function in PHP. 
* @link a much more robust and widely used package handling routing stuffs in PHP here https://github.com/nikic/FastRoute. SlimFramework && Laravel use this one. The behind the scene here is the combination of REGEX as it is elaborated here http://nikic.github.io/2014/02/18/Fast-request-routing-using-regular-expressions.html
* @see the reference from Tài "tốt tính" videos at https://www.youtube.com/watch?v=6QD3Mvqs09E&list=PL4m3Y7pzfrGmG7DEQ4lBaIW8mE6oivnCS&index=13
* @link another routing package https://github.com/c9s/Pux
* @link another standard package http://route.thephpleague.com/
* @link a very long discussion about routing https://github.com/symfony/symfony/pull/21926
* @author Vuong Nguyen
* @since 10th May 2018
*/
declare(strict_types=1);
//namespace App\Core;

use app\core\AppException;

class Router
{
	/**
	* @var static variable array
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
		* If empty => return '/' OTHERWISE, RETURN $url
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
		$httpMethod = $url = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD']: 'GET';

		return $httpMethod;

	}
	/**
	* @param string $method
	* @param string $url
	* @return array self::$routers[]
	*/
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
			
			App::setController($className);

			/**class exists, then create a new object*/
			$object = new $classnamespace;
	
			if (method_exists($classnamespace, $methodName)){

				App::setAction($methodName);
				/*call the method using the $params*/
				call_user_func_array([$object, $methodName], $params);

			} else {

				die("Method $methodName not found");
			}
			
		} else {

			die("Class $classnamespace not found");
		}


	}

	public function run()
	{
		$this->match();
	}
}


?>