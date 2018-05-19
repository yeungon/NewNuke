<?php

namespace app\core;
/**
* Core Controller - All "children" controllers need to extend this "mother" controller to use the following functions
*/
class Controller
{
	
	public function __construct()
	{
		
	}

	public function redirect($url, $isEnd = true, $resPonseCode = 302)
	{
		header("Location:".$url, true, $resPonseCode);
		if ($isEnd) {
			die();
		}
	}

	public function render($view, $data)
	{
		/*if (condition) {
			# code...
		}*/
	}

	public function renderPartial()
	{
		
	}
}