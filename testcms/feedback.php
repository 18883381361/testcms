<?php
require 'init.inc.php';
global $tpl;
$feekback=new FeedbackAction($tpl);
$feekback->action();
$tpl->display('feedback.tpl');
