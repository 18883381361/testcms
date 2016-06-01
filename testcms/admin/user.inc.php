<?php 
require '../init.inc.php';
Validate::is_session();
Validate::checkPremission('13', '您没有管理会员的权限');
global $tpl;
$user=new UserAction($tpl);
$user->action();
$tpl->display('user.tpl');









?>