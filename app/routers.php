<?php
	//use app\core\Controller;

	
	Router::get('/home',function(){
		echo '<h2> hello from @home router home GET </h2>';
	});


	Router::get('/abce','HomeController@hello');
	
	/*Router::get('/',function(){
		$ct = new Controller;
		$ct->render('index',['age' => 22, 'name' => 'tai']);
	});*/

	Router::get('/',function(){
		echo '<h1> hello đây index</h1>';
	});


	Router::any('*',function(){
		echo '404';
	});
?>