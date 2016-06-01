<?php 
//require substr(dirname(__FILE__), 0,-5).'init.inc.php';
require '../init.inc.php';
  Validate::is_session();
  global $tpl;
  $tpl->display('admin.tpl');
?>