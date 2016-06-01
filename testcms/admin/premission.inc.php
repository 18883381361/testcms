<?php 
require '../init.inc.php';
Validate::is_session();
Validate::checkPremission('5', '您没有管理权限的权限');
global $tpl;
$premission=new PremissionAction($tpl);
$premission->action();
$tpl->display('premission.tpl');









?>