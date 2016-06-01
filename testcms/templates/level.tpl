<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css"/>
<script type="text/javascript" src=../js/admin_manage.js></script>
</head>
<body id="main">    
    <p>管理首页&gt;&gt;等级管理&gt;&gt;<strong id="title">{$title}</strong></p>
    
    <ol>
        <li><a href="level.inc.php?action=show" class="selected">等级列表</a></li>
        <li><a href="level.inc.php?action=add">新增等级</a></li>
    
    {if $update}
        <li><a href="level.inc.php?action=update" class="selected">修改等级</a></li>
    {/if}
    </ol>
    {if $show}
        <table cellspacing="0">
            <tr><th>等级</th><th>等级名称</th><th>等级信息</th><th>权限标识</th><th>操作</th></tr>
            {if $total}
            {foreach $level(key,value)}
            <tr>
                <td>{@value->level}</td>
                <td>{@value->level_name}</td>
                <td>{@value->level_info}</td>
                <td>{@value->premission}</td>
                <td><a href="level.inc.php?action=update&id={@value->id}">修改</a> | <a href="level.inc.php?action=delete&id={@value->id}" onclick="return confirm('你真的要删除该等级吗?')?true:false">删除</a></td>
            </tr>
            {/foreach}
            {else}
                <tr><td colspan=4>对不起，没有任何数据</td></tr>
            {/if}
        </table>
        <p class="add">[<a href="level.inc.php?action=add">新增等级</a>]</p>
    {/if}
    <!-- 修改页面 -->
    {if $update}
        <form method="post" name="update">
        <input type="hidden" name="id" value="{$update_id}"/>
            <dl>
               <dd>等　　级:<input name="level" type="text" class="text" value="{$update_level}"/>(*必须位数字)</dd>
                <dd>等级名称:<input name="level_name" type="text" class="text" value="{$update_level_name}"/>(*不得小于2位或者大于20位)</dd>
                <dd>等级信息:<textarea name="level_info">{$update_level_info}</textarea>(*描述不得大于200位)</dd>
                <dd style="width:29%;">
                    {if $allPremission}
                        {foreach $allPremission(key,value)}
                            <input type="checkbox" value="{@value->id}" name="premission[]" {@value->check}>{@value->name}</input>
                        {/foreach}
                    {/if}
                </dd>
                <dd><input name="send" type="submit" onclick="return checkLevel()" class="submit" value="修改等级"/>　[ <a href="level.inc.php?action=show">返回列表</a> ]</dd>
            </dl>
        </form>
    {/if}
    
    <!-- 新增页面 -->
    {if $add}
          <form method="post" name="add">
            <dl>
                <dd>等　　级:<input name="level" type="text" class="text"/>(*必须位数字)</dd>
                <dd>等级名称:<input name="level_name" type="text" class="text"/>(*不得小于2位或者大于20位)</dd>
                <dd>等级信息:<textarea name="level_info"></textarea>(*描述不得大于200位)</dd>
                <dd style="width:29%;">
                    {if $allPremission}
                        {foreach $allPremission(key,value)}
                            <input type="checkbox" value="{@value->id}" name="premission[]">{@value->name}</input>
                        {/foreach}
                    {/if}
                </dd>
                <dd><input name="send" type="submit" onclick="return checkLevel()" class="submit" value="新增等级"/>　[ <a href="level.inc.php?action=show">返回列表</a> ]</dd>
            </dl>
        </form>
    {/if}

</body>
</html>