<?php

return[
	'public' 		=>	$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],
	'rootpublic' 	=> dirname(__DIR__).'/public/',
  'basePath' => '/vietphp/public',
	/*thư mục gốc, dirname lồng nhau*/
	'rootDir' 		=> dirname(__DIR__),
	'layout'  		=> 'layouts/main'

];

?>
