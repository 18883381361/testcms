<?php 
require '../init.inc.php';
Validate::is_session();
Validate::checkPremission('11', '您没有管理投票的权限');
global $tpl;
$vote=new VoteAction($tpl);
$vote->action();
$tpl->display('vote.tpl');









?>