<?php 
require '../init.inc.php';
Validate::is_session();
Validate::checkPremission('8', '您没有管理评论的权限');
global $tpl;
$commend=new CommendAction($tpl);
$commend->action();
$tpl->display('commend.tpl');









?>