<?php
	declare(strict_types=1);
	/**
	* New Nuke is a PHP Framework originally created as an experience while I was dealing with a bundle of new interesting features 
	* released in * PHP 7 and while I was preparing materials for taking the Zend Certifield Engineer test. \
	* A heap of thanks should go to "Tài tốt tính" for his tutorial
	* @author Vuong Nguyen me@vuongnguyen.net
	* @license MIT
	* @see https://www.youtube.com/playlist?list=PL4m3Y7pzfrGmG7DEQ4lBaIW8mE6oivnCS (Vietnamese, free tutorial)
	* @see https://www.udemy.com/php-mvc-from-scratch/learn/v4/content (English, paid course)
	* @see discussion here https://news.ycombinator.com/item?id=16725492 and 
	* @see initial introduction here https://kevinsmith.io/modern-php-without-a-framework
	* @see the link and its second part at https://medium.com/shecodeafrica/building-your-own-custom-php-framework-part-1-1d24223bab18
	* @see some introductions from the creator of Symfony https://symfony.com/doc/current/create_framework/index.html
	* @since 15 May 2018
	*/

	require(__DIR__.'/../app/core/App.php');
	
	/*Global variable*/	
	$config = require_once dirname(__DIR__) . '/./config/main.php';

	/*Setting up the configuration in the config\main.php*/
	App::setConfig($config);

	/**
	* Initiate a new object
	* Setting up the autoload from composer "app\\core\\VietPhp\\": "app/core",
	*/
	$app  = new App;

	$app->dispatch();