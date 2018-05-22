<?php

return[
	'basePath' 		=> '/vietphpdev/public',
	'public' 		=>	$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],
	'rootpublic' 	=> dirname(__DIR__).'/public/',
	/*thư mục gốc, dirname lồng nhau*/
	'rootDir' 		=> dirname(__DIR__),
	'layout'  		=> 'layouts/main'

];

?>
