<?php

namespace app\controllers;

use app\core\Controller;
/**
* HomeController
*/
class HomeController extends Controller
{
	
	function __construct()
	{
		//print "đây là nội dung từ homecontroller Home Controller";
	}

	public function index($abc, $cde)
	{
		echo "đây là nội dung từ home index, với tham số $abc và $cde";
	}
}