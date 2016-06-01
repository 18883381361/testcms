<?php
require 'init.inc.php';
global $tpl;
$search=new SearchAction($tpl);
$search->action();
$tpl->display('search.tpl');
