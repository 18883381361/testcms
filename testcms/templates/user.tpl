<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css"/>
<script type="text/javascript" src=../js/admin_manage.js></script>
</head>
<body id="main">    
    <p>会员管理&gt;&gt;查看会员列表&gt;&gt;<strong id="title">{$title}</strong></p>
    
    <ol>
        <li><a href="user.inc.php?action=show" class="selected">会员列表</a></li>
        <li><a href="user.inc.php?action=add">新增会员</a></li>
    
    {if $update}
        <li><a href="user.inc.php?action=update" class="selected">修改会员</a></li>
    {/if}
    </ol>
<!--显示会员列表-->
    {if $show}
        <table cellspacing="0">
            <tr><th>编号</th><th>用户名</th><th>电子邮件</th><th>状态</th><th>操作</th></tr>
            {if $user}
            <form method="post" action="nav.inc.php?action=sort">
            {foreach $user(key,value)}
            <tr>
                <td><script type="text/javascript">document.write({@key+1}+{$pagesize});</script></td>
                <td>{@value->username}</td>
                <td>{@value->email}</td>
                <td>{@value->state}</td>
                <td><a href="user.inc.php?action=update&id={@value->id}">修改</a> | <a href="user.inc.php?action=delete&id={@value->id}" onclick="return confirm('你真的要删除该会员吗?')?true:false">删除</a></td>
            </tr>
            {/foreach}
            </form>
            {else}
                <tr><td colspan=5>对不起，没有任何数据</td></tr>
            {/if}
        </table>
       
        <p class="add">[<a href="user.inc.php?action=add">新增会员</a>]</p>
        <div id="page"><p>{$page}</p></div>
    {/if}
    <!-- 修改页面 -->
    {if $update}
        <form method="post" action="?action=update" name="add">
        <input type="hidden" value="{$id}" name="id"/>
        <input type="hidden" value="{$prev_url}" name="prev_url"/>
		<dl>
			<dd>用 户 名：<input type="text" class="text" name="username" value="{$username}"/> <span style="color: red;">[必填]</span> ( *用户名在2到20位之间 )</dd>
			<dd>密　　码：<input type="password" class="text" name="password" /> <span style="color: red;">[必填]</span> ( *留空则不修改 )</dd>		
			<dd>电子邮件：<input type="text" class="text" name="email" value="{$email}"/> <span style="color: red;">[必填]</span> ( *每个电子邮件只能注册一个ID )</dd>
			<dd>头像选择：<select name="face" onchange="selectFace()">
			        {$face}
			    </select>
		    <dd>
			<dd><img alt="" src="../images/{$faceimg}" name="img"></dd>
			<dd>安全问题：<select name="question">
			                         <option value="">没有任何安全问题</option>
									{$question}
									</select>
			</dd>
			<dd>问题答案：<input type="text" class="text" name="answer" value="{$answer}"/></dd>
			
		    <dd>设置权限：{$state}
									
		    </dd>
		    <dd><input type="submit" class="submit" name="send" value="修改会员" onclick="return checkUserUpdate()" style="margin:0 0 0 100px;"/></dd>
		</dl>
	</form>
    {/if}
    
    <!-- 新增页面 -->
    {if $add}
          <form method="post" action="?action=add" name="add">
		<dl>
			<dd>用 户 名：<input type="text" class="text" name="username" /> <span style="color: red;">[必填]</span> ( *用户名在2到20位之间 )</dd>
			<dd>密　　码：<input type="password" class="text" name="password" /> <span style="color: red;">[必填]</span> ( *密码不得小于6位 )</dd>
			<dd>密码确认：<input type="password" class="text" name="notpassword" /> <span style="color: red;">[必填]</span> ( *密码确认和密码一致 )</dd>
			<dd>电子邮件：<input type="text" class="text" name="email" /> <span style="color: red;">[必填]</span> ( *每个电子邮件只能注册一个ID )</dd>
			<dd>头像选择：<select name="face" onchange="selectFace()">
			         {foreach $faceOne(key,value)}
			         <option value="0{@value}.gif">0{@value}.gif</option>
			         {/foreach}
			         {foreach $faceTwo(key,value)}
			         <option value="{@value}.gif">{@value}.gif</option>
			         {/foreach}
			    </select>
		    <dd>
			<dd><img alt="" src="../images/01.gif" name="img"></dd>
			<dd>安全问题：<select name="question">
									   <option value="">没有任何安全问题</option>
										<option value="您父亲的姓名？">您父亲的姓名？</option>
										<option value="您母亲的职业？">您母亲的职业？</option>
										<option value="您配偶的性别？">您配偶的性别？</option>	
									</select>
			</dd>
			<dd>问题答案：<input type="text" class="text" name="answer" /></dd>
			
		    <dd>设置权限：<input type="radio" name="state" value="0" /> 被封杀的会员
									<input type="radio" name="state" value="1" /> 待审核的会员
									<input type="radio" name="state" value="2" checked="checked" /> 初级会员
									<input type="radio" name="state" value="3" /> 中级会员
									<input type="radio" name="state" value="4" /> 高级会员
									<input type="radio" name="state" value="5" /> VIP会员
		    </dd>
		    <dd><input type="submit" class="submit" name="send" value="新增会员" onclick="return checkUserAdd()" style="margin:0 0 0 100px;"/></dd>
		</dl>
	</form>
    {/if}
</body>
</html>