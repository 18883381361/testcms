<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CMS后台登录界面</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css"/>
<script type="text/javascript" src=../js/admin_manage.js></script>
</head>
<body id="adminLogin">
	 <form method="post" action="?action=login" name="login">
        <fieldset>
            <legend>CMS后台登录界面</legend>
            <label>用户名:<input name="admin_name" type="text" class="text"/></label>
            <label>密　码:<input name="admin_pass" type="password" class="text"/></label>
            <label>验证码:<input name="code" type="text" class="code"/><img alt="验证码" src="../config/code.php" id="code" onclick="freshCode()"/></label>
                 <input name="admin_login" type="submit" onclick="return checkAdminLogin()" class="submit" value="登录"/>
        </fieldset>
    </form>
</body>
</html>