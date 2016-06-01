<?php 
require '../init.inc.php';
global $tpl;
$main=new MainAction($tpl);
$main->action();
$tpl->display('main.tpl');
?>