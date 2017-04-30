<?php 
	header('content-type:text/html;charset=utf8');

    // 跨域支持
    header("Access-Control-Allow-Origin: baihaobio.com");
    header("Access-Control-aLLOW-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE");

	date_default_timezone_set('PRC');
	define('APP_PATH','./Web/');

    // 图片库路径
    define('IMAGE_PATH', './Image');
	//开启调试模式
	define('APP_DEBUG',true);
    //关闭缓存
    define('DB_FIELD_CACHE',false);
    define('HTML_CACHE_ON',false);

	require './ThinkPHP/ThinkPHP.php';

 ?>