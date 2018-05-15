<?php
/**
* Router
*/
class Router
{
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
		
		$url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI']: '/';
				
		/*remove the initial part of the url*/
		$url = str_replace('/vietphp/public', '', $url);

		/** check the url 
		* if empty => return '/' ORTHERWISE, RETURN $url
		*/
		
		$url = $url === '' || empty($url)? '/': $url;

		return $url;

	}

	private function getRequestMethod()
	{
		$method = $url = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD']: 'GET';
		return $method;

	}
	
	private function addRoute($url, $action)
	{
		$this->routers[] = [$url, $action];
	}

	public function get($url, $action)
	{
		$this->addRoute($url, $action);
	}

	public function post($url, $action)
	{
		$this->addRoute($url, $action);	
	}

	public function any($url, $action)
	{
		$this->addRoute($url, $action);
	}

	public function run()
	{
		//$url = $this->getRequestURL();

		//echo $url;

		$method = $this->getRequestMethod();
		echo $method;

		echo "<pre>";
		print_r($this->routers);
	}
}


?>