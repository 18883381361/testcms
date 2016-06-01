<?php
require 'init.inc.php';
global $tpl;
$login=new IndexAction($tpl);
$login->action();
$tpl->display('index.tpl');
