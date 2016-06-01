<?php 
require '../init.inc.php';
Validate::is_session();
Validate::checkPremission('12', '您没有管理友情链接的权限');
global $tpl;
$link=new LinkAction($tpl);
$link->action();
$tpl->display('link.tpl');









?>