<?php
define('APP_DEBUG',true);//调试模式
ob_start('ob_gzhandler');
define( 'RUNTIME_PATH' , './Public/Cache/Admin/' );
define( 'COMMON_PATH' , './Public/Common/' );
define('HTML_PATH', './Html/');
define('ALIZI_VERSION','Alizi-V2.4.6');
define('APP_NAME','Admin');
define('APP_PATH','./Admin/');
require 'Public/ThinkPHP/ThinkPHP.php';
?>