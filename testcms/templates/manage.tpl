<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css"/>
<script type="text/javascript" src=../js/admin_manage.js></script>
</head>
<body id="main">    
    <p>管理首页&gt;&gt;管理员管理&gt;&gt;<strong id="title">{$title}</strong></p>
    
    <ol>
        <li><a href="manage.inc.php?action=show" class="selected">管理员列表</a></li>
        <li><a href="manage.inc.php?action=add">新增管理员</a></li>
    
    {if $update}
        <li><a href="manage.inc.php?action=update" class="selected">修改管理员</a></li>
    {/if}
    </ol>
    {if $show}
        <table cellspacing="0">
            <tr><th>编号</th><th>用户名</th><th>等级</th><th>登录次数</th><th>最近登录时间</th><th>最近登录IP</th><th>操作</th></tr>
            {if $total}
            {foreach $manage(key,value)}
            <tr>
                <td><script type="text/javascript">document.write({@key+1}+{$pagesize});</script></td>
                <td>{@value->admin_user}</td>
                <td>{@value->level_name}</td>
                <td>{@value->login_count}</td>
                <td>{@value->last_time}</td>
                <td>{@value->last_ip}</td>
                <td><a href="manage.inc.php?action=update&id={@value->id}">修改</a> | <a href="manage.inc.php?action=delete&id={@value->id}" onclick="return confirm('你真的要删除该管理员吗?')?true:false">删除</a></td>
            </tr>
            {/foreach}
            {else}
                <tr><td colspan=4>对不起，没有任何数据</td></tr>
            {/if}
        </table>
        <p class="add">[<a href="manage.inc.php?action=add">新增管理员</a>]</p>
        <div id="page"><p>{$page}</p></div>
    {/if}
    <!-- 修改页面 -->
    {if $update}
        <input type="hidden" id="level" value="{$update_level}"/>
        <form method="post" name="update">
        <input type="hidden" name="id" value="{$update_id}"/>
        <input type="hidden" name="prev_url" value="{$prev_url}"/>
            <dl>
                <dd>用户名:<input name="username" type="text" class="text" value="{$update_user}"/>(*不得小于2位或者大于20位)</dd>
                <dd>密　码:<input name="password" type="password" class="text"/>(*留空则不修改)</dd>
                <dd>等　级:<select name="level" id="options">
                            {foreach $alllevel(key,value)}
                            <option value="{@value->level}">{@value->level_name}</option>
                            {/foreach}
                         </select></dd>
                <dd><input name="send" type="submit" onclick="return checkManageUpdate()" class="submit" value="修改管理员"/>　[ <a href="{$prev_url}">返回列表</a> ]</dd>
            </dl>
        </form>
    {/if}
    
    <!-- 新增页面 -->
    {if $add}
          <form method="post" name="add">
            <dl>
                <dd>用 户 名:<input name="username" type="text" class="text"/> (*不得小于2位或者大于20位)</dd>
                <dd>密　　码:<input name="password" type="password" class="text"/> (*不得小于6位)</dd>
                <dd>密码确认:<input name="notpassword" type="password" class="text"/> (*必须同密码一致)</dd>
                <dd>等　级:<select name="level">
                            {foreach $alllevel(key,value)}
                            <option value="{@value->level}">{@value->level_name}</option>
                            {/foreach}
                         </select></dd>
                <dd><input name="send" type="submit" class="submit" onclick="return checkManageAdd()" value="新增管理员"/>　[ <a href="{$prev_url}">返回列表</a> ]</dd>
            </dl>
        </form>
    {/if}

</body>
</html>