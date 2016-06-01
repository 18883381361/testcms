<?php 
require '../includes/ValidateCode.class.php';
session_start();
$code=new ValidateCode();
$_SESSION['code']=strtolower($code->getCode());
$code->checkCode();
?>