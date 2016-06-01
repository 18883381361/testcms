<?php 
require '../init.inc.php';
global $tpl;
$tpl->assign('admin_name', $_SESSION['admin']['admin_name']);
$tpl->assign('level_name', $_SESSION['admin']['level_name']);
$tpl->display('top.tpl');
?>