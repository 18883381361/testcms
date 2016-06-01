<?php 
    require 'includes/Image.class.php';
   // $filename="photo\\20160406\\1459919880.jpg";
   $filename=$_GET['filename'];
   $percent=$_GET['percent'];
    new Image($filename,$percent);
?>