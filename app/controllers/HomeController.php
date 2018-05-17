<?php

namespace app\controllers;
/**
* HomeController
*/
class HomeController
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