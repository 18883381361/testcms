<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>sidebar</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css"/>
</head>
<body id="main">
	<form method="post" action="../config/upload.php" enctype="multipart/form-data" style="text-align:center;margin:30px;">
		<input type="hidden" name="type" value="<?php echo $_GET['type']?>"/>
		<input type="hidden" name="size" value="<?php echo $_GET['size']?>"/>
		<input type="hidden" name="MAX_FILE_SIZE" value="2048000" />
		<input type="file" name="pic" />
		<input type="submit" name="send" value="确定" />
	</form>
	
</body>
</html>