<?php 
require '../init.inc.php';
Validate::is_session();
Validate::checkPremission('6', '您没有管理导航的权限');
global $tpl;
$nav=new NavAction($tpl);
$nav->action();
$tpl->display('nav.tpl');









?>