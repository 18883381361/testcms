<?php 
    require '../init.inc.php';
    global $tpl;
    $login=new LoginAction($tpl);
    $login->action();
    if(isset($_SESSION['admin'])) header("Location:admin.php");   
    $tpl->display('admin_login.tpl');
?>