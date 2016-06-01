 <?php 
 session_start();
//设置编码
header('Content-Type:text/html;charset=utf-8');
//设置时区
date_default_timezone_set('Asia/Shanghai');
//网站根目录
define(ROOT_PATH,dirname(__FILE__).'\\');
require ROOT_PATH.'config/profile.inc.php';
//定义不缓存
$noCacheArray=array('upload','code','static','ckeup','register','feedback','cast','friendlink','search');
$noCache= in_array(Tool::toTpl(), $noCacheArray);

//创建模版句柄
global $tpl;
$tpl=new Templates($noCacheArray);
//初始化文件
require 'common.inc.php';
//自动加载类
function __autoload($className){
    if(substr($className,-6)=='Action'){
        require ROOT_PATH.'action/'.$className.'.class.php';
    }elseif(substr($className,-5)=='Model'){
        require ROOT_PATH.'model/'.$className.'.class.php';
    }else{
        require ROOT_PATH.'includes/'.$className.'.class.php';
    }
}
?>