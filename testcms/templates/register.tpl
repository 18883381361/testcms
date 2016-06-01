<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$webname}</title>
<link rel="stylesheet" type="text/css" href="style/register.css" />
<link rel="stylesheet" type="text/css" href="style/basic.css" />
<script type="text/javascript" src="js/front.js"></script>
</head>
<body>
{include file='header.tpl'}
<!-- 注册界面 -->
{if $reg}
<div id="reg">
    <h2>会员注册</h2>
    <form method="post" action="?action=reg" name="add">
		<dl>
			<dd>用 户 名：<input type="text" class="text" name="username" /> <span class="red">[必填]</span> ( *用户名在2到20位之间 )</dd>
			<dd>密　　码：<input type="password" class="text" name="password" /> <span class="red">[必填]</span> ( *密码不得小于6位 )</dd>
			<dd>密码确认：<input type="password" class="text" name="notpassword" /> <span class="red">[必填]</span> ( *密码确认和密码一致 )</dd>
			<dd>电子邮件：<input type="text" class="text" name="email" /> <span class="red">[必填]</span> ( *每个电子邮件只能注册一个ID )</dd>
			<dd>头像选择：<select name="face" onchange="selectFace()">
			         {foreach $faceOne(key,value)}
			         <option value="0{@value}.gif">0{@value}.gif</option>
			         {/foreach}
			         {foreach $faceTwo(key,value)}
			         <option value="{@value}.gif">{@value}.gif</option>
			         {/foreach}
			    </select>
		    <dd>
			<dd><img alt="" src="images/01.gif" name="img"></dd>
			<dd>安全问题：<select name="question">
										<option>没有任何安全问题</option>
										<option>您父亲的姓名？</option>
										<option>您母亲的职业？</option>
										<option>您配偶的性别？</option>
									</select>
			</dd>
			<dd>问题答案：<input type="text" class="text" name="answer" /></dd>
			<dd>验 证 码：<input type="text" class="text" name="code" /> <span class="red">[必填]</span><img src="config/code.php" onclick="freshCode()" id="code"/></dd>
			<dd><input type="submit" class="submit" name="send" value="注册会员" onclick="return checkUserAdd()"/></dd>
		</dl>
	</form>
</div>
{/if}
<!-- 登录界面 -->
{if $login}
<div id="reg">
	<h2>会员登录</h2>
	<form method="post" name="login" action="?action=login">
		<dl>
			<dd>用 户 名：<input type="text" class="text" name="username" /> <span class="red">[必填]</span> ( *用户名在2到20位之间 )</dd>
			<dd>密　　码：<input type="password" class="text" name="password" /> <span class="red">[必填]</span> ( *密码不得小于6位 )</dd>
			<dd>登录保留：<input type="radio" name="time" checked="checked" value="0" /> 不保留
									<input type="radio" name="time" value="86400" /> 一天
									<input type="radio" name="time" value="604800" /> 一周
									<input type="radio" name="time" value="2592000" /> 一月
			</dd>
			<dd>验 证 码：<input type="text" class="text" name="code" /> <span class="red">[必填]</span><img src="config/code.php" onclick="freshCode()" id="code" /></dd>
			<dd><input type="submit" class="submit" name="send" onclick="return checkLogin();" value="登录" /></dd>
		</dl>
	</form>
</div>
{/if}
{include file='footer.tpl'}
</body>
</html>