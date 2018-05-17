<?php
/**
* Router
*/
declare(strict_types=1);
namespace app\core\Router;

class Router
{
	/**
	* Array contains the routes
	* @var array
	*/
	private $routers = [];

	function __construct()
	{
		# code...
	}

	/**
	*@param void
	*@return REQUEST_URI from the gobal constant $_REQUEST. "/" if isset is NULL
	*/
	private function getRequestURL()
	{
		/**/
		$basePath = \app\core\VietPhp\App::getConfig()['basePath'];

		$url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI']: '/';
				
		/*remove the initial part of the url*/
		$url = str_replace($basePath, '', $url);

		/** check the url 
		* if empty => return '/' ORTHERWISE, RETURN $url
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
	
	private function addRoute($method, $url, $action)
	{
		$this->routers[] = [$method, $url, $action];
	}

	public function get($url, $action)
	{
		$this->addRoute('GET', $url, $action);
	}

	public function post($url, $action)
	{
		$this->addRoute('POST', $url, $action);	
	}

	public function any($url, $action)
	{
		$this->addRoute('GET|POST', $url, $action);

	}

	public function match()
	{
			$checkRoute = false;
			$params 	= [];

			$requestURL = $this->getRequestURL();
			$requestMethod = $this->getRequestMethod();
			$routers = $this->routers;
			
			foreach ($routers as $route ){
				[$method,$url,$action] = $route;

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

				if( $checkRoute === true ){
					if( is_callable($action) ){
						call_user_func_array($action, $params);
					}
					elseif( is_string($action) ){
						$this->compieRoute($action,$params);
					}
					return;
				}else{
					continue;
				}
			}
			return;
		}
	
	private function compieRoute($action, $params){

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