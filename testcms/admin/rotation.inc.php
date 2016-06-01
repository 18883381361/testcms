<?php 
require '../init.inc.php';
Validate::is_session();
Validate::checkPremission('9', '您没有管理轮播图的权限');
global $tpl;
$rotation=new RotationAction($tpl);
$rotation->action();
$tpl->display('rotation.tpl');









?>