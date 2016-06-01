<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css"/>
</head>
<body id="main">
    <p>管理首页&gt;&gt;后台首页</p>
     <table cellspacing="0">
        <tr><th>快捷操作</th></tr>
        <tr><td><input type="button" value="清理缓存" onclick="javascript:location.href='main.inc.php?action=deleteCache'"/>(缓存目录现在<span style="color:red;">{$cacheNum}</span>个文件)</td></tr>
     </table>
</body>
</html>