<?php 
	header('content-type:text/html;charset=utf8');
	date_default_timezone_set('PRC');
	define('APP_PATH','./Web/');

    // 图片库路径
    define('IMAGE_PATH', './Image');
	//开启调试模式
	define('APP_DEBUG',true);
	
	require './ThinkPHP/ThinkPHP.php';

 ?>