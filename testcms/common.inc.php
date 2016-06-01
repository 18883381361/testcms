<?php 
define('IS_CACHE', false);
//引入导航类
global $tpl,$noCache;
if(IS_CACHE && !$noCache){
    ob_start();
    $tpl->cache(Tool::toTpl().'.tpl');
}
$nav=new NavAction($tpl);
$nav->showFrontNav();
if(IS_CACHE){
    $tpl->assign('header', '<script type="text/javascript">getHeaderLoginUser();</script>');
}else{
    if(isset($_COOKIE['user'])){
        $tpl->assign('header', '<span>欢迎您['.$_COOKIE['user'].']　<a href="register.php?action=logout">退出</a></span>');
    }else{
        $tpl->assign('header', '<a href="register.php?action=reg" class="user">注册</a>
        <a href="register.php?action=login" class="user">登录</a>');
    }
}
$_link = new FriendLinkAction($tpl);
$_link->index();
$tag = new SearchAction($tpl);
$tag->showTag();
$tpl->assign('webname', WEBNAME);
//$tpl->display('header.tpl');
?>