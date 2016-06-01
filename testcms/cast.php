<?php
require 'init.inc.php';
global $tpl;
$cast=new CastAction($tpl);
$cast->action();
$tpl->display('cast.tpl');
