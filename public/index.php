<?php
	declare(strict_types=1);
	/**
	* New Nuke is a leanring-by-creating project which is a PHP Framework originally created as an experience
	* while I was dealing with a  bundle of new interesting features released in PHP 7 && 
	* and while I was preparing materials for taking the Zend Certifield Engineer test even though I have already had some experiences with modern MVC framework such as Codeigniter and Laravel.
	* A heap of thanks should go to "Tài tốt tính" for his tutorial that inspires me the most.
	* @author Vuong Nguyen me@vuongnguyen.net
	* @license MIT
	* @see https://www.youtube.com/playlist?list=PL4m3Y7pzfrGmG7DEQ4lBaIW8mE6oivnCS (Vietnamese, free tutorial)
	* @see https://www.udemy.com/php-mvc-from-scratch/learn/v4/content (English, paid course)
	* @see https://www.udemy.com/complete-php-mvc-tutorial/ (English, paid course)
	* @see https://www.udemy.com/the-complete-php-mvc-course-build-a-modern-php-ecommerce-store/ (English, paid course)
	* @see discussion here https://news.ycombinator.com/item?id=16725492 and 
	* @see initial introduction here https://kevinsmith.io/modern-php-without-a-framework
	* @see the link and its second part at https://medium.com/shecodeafrica/building-your-own-custom-php-framework-part-1-1d24223bab18
	* @see some introductions from the creator of Symfony https://symfony.com/doc/current/create_framework/index.html
	* @since 15 May 2018
	*/
	require(__DIR__.'/../app/core/App.php');
	
	/*Global variable*/	
	$config = require_once dirname(__DIR__) . '/./config/main.php';

	/*
	* Trigger the configuration in the config\main.php
	* App is the class can be found in the app\core\app.com. The file and the classname are both automatically loaded.
	*/
	App::setConfig($config);

	/**
	* Initiate a new object
	* Setting up the autoload from composer "app\\core\\VietPhp\\": "app/core",
	*/
	$app  = new App;

	$app->dispatch();