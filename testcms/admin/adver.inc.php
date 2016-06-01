<?php 
require '../init.inc.php';
Validate::is_session();
Validate::checkPremission('10', '您没有管理广告的权限');
global $tpl;
$adver=new AdverAction($tpl);
$adver->action();
$tpl->display('adver.tpl');









?>