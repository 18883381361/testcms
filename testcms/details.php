<?php
require 'init.inc.php';
global $tpl;
$list=new DetailAction($tpl);
$list->getDetails();
$tpl->display('details.tpl');
