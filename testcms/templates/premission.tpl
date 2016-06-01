<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css"/>
<script type="text/javascript" src=../js/admin_manage.js></script>
</head>
<body id="main">    
    <p>管理首页&gt;&gt;权限管理&gt;&gt;<strong id="title">{$title}</strong></p>
    
    <ol>
        <li><a href="premission.inc.php?action=show" class="selected">权限列表</a></li>
        <li><a href="premission.inc.php?action=add">新增权限</a></li>
    
    {if $update}
        <li><a href="premission.inc.php?action=update" class="selected">修改权限</a></li>
    {/if}
    </ol>
<!--显示权限 -->
    {if $show}
        <table cellspacing="0">
            <tr><th>编号</th><th>权限名称</th><th>权限描述</th><th>操作</th></tr>
            {if $premission}
            <form method="post" action="nav.inc.php?action=sort">
            {foreach $premission(key,value)}
            <tr>
                <td><script type="text/javascript">document.write({@key+1}+{$pagesize});</script></td>
                <td>{@value->name}</td>
                <td>{@value->info}</td>
                <td><a href="premission.inc.php?action=update&id={@value->id}">修改</a> | <a href="premission.inc.php?action=delete&id={@value->id}" onclick="return confirm('你真的要删除该权限吗?')?true:false">删除</a></td>
            </tr>
            {/foreach}
            </form>
            {else}
                <tr><td colspan=4>对不起，没有任何数据</td></tr>
            {/if}
        </table>
        <div id="page"><p>{$page}</p></div>
    {/if}
   
    <!-- 修改页面 -->
    {if $update}
        <form method="post" name="update">
        <input type="hidden" name="id" value="{$update_id}"/>
        <input type="hidden" name="prev_url" value="{$prev_url}"/>
            <dl>
               <dd>权限名称:<input name="name" type="text" class="text" value="{$name}"/>(*不得小于2位或者大于20位)</dd>
                <dd>权限描述:<textarea name="info">{$info}</textarea>(*描述不得大于200位)</dd>
                <dd><input name="send" type="submit" onclick="return checkPremission()" class="submit" value="修改权限"/>　[ <a href="{$prev_url}">返回列表</a> ]</dd>
            </dl>
        </form>
    {/if}
    
    <!-- 新增页面 -->
    {if $add}
          <form method="post" name="add">         
            <dl>            
                <dd>权限名称:<input name="name" type="text" class="text"/>(*不得小于2位或者大于20位)</dd>
                <dd>权限描述:<textarea name="info"></textarea>(*描述不得大于200位)</dd>
                <dd><input name="send" type="submit" onclick="return checkPremission()" class="submit" value="新增权限"/>　[ <a href="{$prev_url}">返回列表</a> ]</dd>
            </dl>
        </form>
    {/if}


</body>
</html>