<?php

namespace app\core;
/**
* Main Controller
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