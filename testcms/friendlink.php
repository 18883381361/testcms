<?php
require 'init.inc.php';
global $tpl;
$friendlink=new FriendLinkAction($tpl);
$friendlink->action();
$tpl->display('friendlink.tpl');
