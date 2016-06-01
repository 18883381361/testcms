<?php 
require '../init.inc.php';
Validate::is_session();
Validate::checkPremission('14', '您没有管理系统设置的权限');
global $tpl;
$system=new SystemAction($tpl);
$system->action();
$tpl->display('system.tpl');









?>