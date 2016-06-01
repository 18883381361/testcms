<?php
//定义数据库
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PWD', '063095aa');
define('DB_NAME', 'cms');

define('WEBNAME','李家勇的网站');//网站名字
define('PAGESIZE','10');//定义每页条数
define('ARTICLESIZE','5');//定义每页条数
define('PREV_URL',$_SERVER['HTTP_REFERER']);//上一页地址
define('NAVSIZE', '10');//前台显示的主导航个数
define('RO_TIME', '3');//轮播图变化时间
define('RO_NUM', '3');//轮播图个数
define('UPDIR', '/uploads/');//上传图片文件夹
define('ADVER_TEXT_NUM', '5');//每次最多循环的文字广告个数
define('ADVER_PIC_NUM', '3');//每次最多循环的图片广告个数

//不可修改的配置文件
define('MARK', ROOT_PATH.'/images/yc.png');//水印图片
//存放模版文件夹
define(TPL_DIR,ROOT_PATH.'templates\\');
//编译文件夹
define(TPL_C_DIR,ROOT_PATH.'templates_c\\');
//缓存文件夹
define(CACHE,ROOT_PATH.'cache\\');
?>
