<?php 
require '../init.inc.php';
Validate::is_session();
Validate::checkPremission('3', '您没有管理管理员的权限');
global $tpl;
$manage=new ManageAction($tpl);
$manage->action();
$tpl->display('manage.tpl');









?>