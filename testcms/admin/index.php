<?php 
require '../init.inc.php';
isset($_SESSION['admin'])?header("Location:admin.php"):header("Location:admin_login.php");
?>