<?php

namespace app\core;
use \App;

/**
* Core Controller - All "children" controllers need to extend this "mother" controller to use the following functions
*/
class Controller
{
	private $layout = null;
	public function __construct()
	{
		$this->layout = App::getConfig()['layout'];
		
	}

	public function setLayout($layout)
	{
		$this->layout = $layout;
	}

	public function redirect($url, $isEnd = true, $resPonseCode = 302)
	{
		header("Location:".$url, true, $resPonseCode);
		if ($isEnd) {
			die();
		}
	}

	/**
	* This function is used to "render" (as the name says :-) the content from the laylouts\main.php && home\file
	*/

	public function render($view, $data = null)
	{ 
		/**
		* $controller = \App::getController();
		* $folderView = strtolower(str_replace('Controller', '', $controller));
		*/

		$rootDir = \App::getConfig()['rootDir'];

		$content = $this->getViewContent($view, $data);
		
		if ($this->layout !== null){
			$layoutPath = $rootDir.'/app/views/'.$this->layout.'.php';

			if (file_exists($layoutPath)){
				require($layoutPath);
			}

		}
	}

	public function getViewContent($view, $data = null)
	{
		$controller = \App::getController();
		
		/*get the folder of the view*/
		$folderView = strtolower(str_replace('Controller', '', $controller));

		/* Get the 'rootDir' configured in the config/main.php */
		$rootDir = \App::getConfig()['rootDir'];

		/**
		* Extract array and turn $key in array into $variable that can be directly printed (the $value) in view template.
		* Note: the third parameter "data" is used IN CASE the $key name HAS BEEN ALREADY USED in the previous variables
		* @see http://php.net/manual/en/function.extract.php
		*/
		if (is_array($data)){
			extract($data, EXTR_PREFIX_SAME, "data");
		} else {
			$data = $data;
		}

		/**
		* Get the content from the app/views/home/file_name.php
		* The file_name is set in the render() function in the HomeController.
		*/
		$viewPath = $rootDir.'/app/views/'.$folderView.'/'.$view.'.php';

		if (file_exists($viewPath)) {
			ob_start();
			
			require($viewPath);
		
			return ob_get_clean();
		}
		
	}
	

	public function renderPartial($view, $data =null)
	{
		
		$rootDir = \App::getConfig()['rootDir'];

		/* Extract array and turn $key in array into $variable that can be directly echoed in view.
		* Note: the third parameter "data" is used IN CASE the $key name HAS BEEN ALREADY USED in the previous variables
		* @see http://php.net/manual/en/function.extract.php
		*/
		if (is_array($data)){
			extract($data, EXTR_PREFIX_SAME, "data");
		} else {
			$data = $data;
		}

		$viewPath = $rootDir.'/app/views/'.$view.'.php';

		if (file_exists($viewPath)) {
			//ob_start();
			
			require($viewPath);
		
			//return ob_get_clean();
		}

	}
}