<?php 
require '../init.inc.php';
Validate::is_session();
Validate::checkPremission('7', '您没有管理文档的权限');
global $tpl;
$content=new ContentAction($tpl);
$content->action();
$tpl->display('content.tpl');









?>