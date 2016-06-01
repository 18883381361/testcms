<?php
require 'init.inc.php';
global $tpl;
$list=new ListAction($tpl);
$list->getNav();
$list->getFrontList();
$tpl->display('list.tpl');
