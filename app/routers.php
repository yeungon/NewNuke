<?php
	/*
	|--------------------------------------------------------------------------
	| Web Routes
	|--------------------------------------------------------------------------
	|
	| Here is where you can register web routes for your application. These
	| routes are loaded by the Core\Route 
	|
	*/
	use app\core\Controller;
	
	Router::get('/',function(){
		
		/*Render the index*/

		$ct = new Controller;
		$ct->render('mainindex', ["name" => "Vượng", "age" => '35']);

	});

	Router::get('/abc','HomeController@index');
	
	/*Router::get('/',function(){
		$ct = new Controller;
		$ct->render('index',['age' => 22, 'name' => 'tai']);
	});*/

	Router::get('/home',function(){
		

		echo '<h4> Hi, you are going to access to the homepage of newnuke/vietfony framework</h4>';
	});


	Router::any('*',function(){
		echo '404 responding code ! Sorry! The URL you are looking for is not available! ';
		
		//echo $this->basePath;
		//header("Location: /index.php");

		//print_r($this->defaultlFileLoad());
	});
?>