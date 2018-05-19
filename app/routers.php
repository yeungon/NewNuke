<?php
	//use app\core\Controller;

	
	Router::get('/home',function(){
		echo '<h2> hello from @home router home GET </h2>';
	});


	Router::get('/abc','HomeController@index');
	
	/*Router::get('/',function(){
		$ct = new Controller;
		$ct->render('index',['age' => 22, 'name' => 'tai']);
	});*/

	Router::get('/',function(){
		echo '<h2> hello world from vietfony framework</h2>';
	});


	Router::any('*',function(){
		echo '404 responding code ! Sorry! The URL you are looking for is not available! ';
		
		//echo $this->basePath;
		//header("Location: /index.php");

		//print_r($this->defaultlFileLoad());
	});
?>