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

	public function render($view, $data = null)
	{ 
		$controller = \App::getController();
		
		/*get the folder of the view*/
		$folderView = strtolower(str_replace('Controller', '', $controller));

		$rootDir = App::getConfig()[
			'rootDir'];

		$viewPath = $rootDir.'/app/views/'.$folderView.'/'.$view.'.php';

		if (file_exists($viewPath)) {
			require($viewPath);
		}

		//print_r($rootDir);

		//App::getAction();

		

		//echo $folderView;
		
	}

	public function renderPartial()
	{
		
	}
}