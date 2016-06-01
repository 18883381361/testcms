<?php 
require '../init.inc.php';
Validate::is_session();
Validate::checkPremission('4', '您没有管理等级的权限');
global $tpl;
$level=new LevelAction($tpl);
$level->action();
$tpl->display('level.tpl');









?>