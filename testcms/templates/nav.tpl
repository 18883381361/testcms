<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css"/>
<script type="text/javascript" src=../js/admin_manage.js></script>
</head>
<body id="main">    
    <p>内容管理&gt;&gt;设置网址导航&gt;&gt;<strong id="title">{$title}</strong></p>
    
    <ol>
        <li><a href="nav.inc.php?action=show" class="selected">导航列表</a></li>
        <li><a href="nav.inc.php?action=add">新增导航</a></li>
    
    {if $update}
        <li><a href="nav.inc.php?action=update" class="selected">修改导航</a></li>
    {/if}
    {if $addchild}
        <li><a href="nav.inc.php?action=addchild" class="selected">新增子导航</a></li>
    {/if}
    {if $showchild}
        <li><a href="nav.inc.php?action=showchild" class="selected">查看子导航</a></li>
    {/if}
    </ol>
<!--显示主导航 -->
    {if $show}
        <table cellspacing="0">
            <tr><th>编号</th><th>导航名称</th><th>导航信息</th><th>子类</th><th>操作</th><th>排序</th></tr>
            {if $total}
            <form method="post" action="nav.inc.php?action=sort">
            {foreach $nav(key,value)}
            <tr>
                <td><script type="text/javascript">document.write({@key+1}+{$pagesize});</script></td>
                <td>{@value->nav_name}</td>
                <td>{@value->nav_info}</td>
                <td><a href="nav.inc.php?action=showchild&id={@value->id}">查看</a> | <a href="nav.inc.php?action=addchild&id={@value->id}" >增加子类</a></td>
                <td><a href="nav.inc.php?action=update&id={@value->id}">修改</a> | <a href="nav.inc.php?action=delete&id={@value->id}" onclick="return confirm('你真的要删除该导航吗?')?true:false">删除</a></td>
                <td><input type="text" name="sort[{@value->id}]" value="{@value->sort}" class="text"/></td>
            </tr>
            {/foreach}
            <tr><td></td><td></td><td></td><td></td><td></td><td><input type="submit" value="排序" name="send"/></td></tr>
            </form>
            {else}
                <tr><td colspan=6>对不起，没有任何数据</td></tr>
            {/if}
        </table>
       
        <p class="add">[<a href="nav.inc.php?action=add">新增导航</a>]</p>
        <div id="page"><p>{$page}</p></div>
    {/if}
    <!--显示子导航 -->
    {if $showchild}
        <table cellspacing="0">
            <tr><th>编号</th><th>导航名称</th><th>导航信息</th><th>操作</th><th>排序</th></tr>
            {if $total}
             <form method="post" action="nav.inc.php?action=sort">
            {foreach $navchild(key,value)}
            <tr>
                <td><script type="text/javascript">document.write({@key+1}+{$pagesize});</script></td>
                <td>{@value->nav_name}</td>
                <td>{@value->nav_info}</td>
                <td><a href="nav.inc.php?action=update&id={@value->id}">修改</a> | <a href="nav.inc.php?action=delete&id={@value->id}" onclick="return confirm('你真的要删除该导航吗?')?true:false">删除</a></td>
                <td><input type="text" name="sort[{@value->id}]" value="{@value->sort}" class="text"/></td>
            </tr>
            {/foreach}
            <tr><td></td><td></td><td></td><td></td><td></td><td><input type="submit" value="排序" name="send"/></td></tr>
            </form>
            {else}
                <tr><td colspan=4>对不起，没有任何数据</td></tr>
            {/if}
                            <tr><td colspan=4>本类隶属于　<strong>{$prev_name}</strong>　[ <a href="nav.inc.php?action=addchild&id={$prev_id}">增加本类</a> ]　[ <a href="{$prev_url}">返回列表</a> ]</td></tr>
        </table>
        <div><p>{$page}</p></div>
    {/if}
    <!-- 修改页面 -->
    {if $update}
        <form method="post" name="update">
        <input type="hidden" name="id" value="{$update_id}"/>
        <input type="hidden" name="prev_url" value="{$prev_url}"/>
            <dl>
               <dd>导航名称:<input name="nav_name" type="text" class="text" value="{$nav_name}"/>(*不得小于2位或者大于20位)</dd>
                <dd>导航信息:<textarea name="nav_info">{$nav_info}</textarea>(*描述不得大于200位)</dd>
                <dd><input name="send" type="submit" onclick="return checkNav()" class="submit" value="修改导航"/>　[ <a href="{$prev_url}">返回列表</a> ]</dd>
            </dl>
        </form>
    {/if}
    
    <!-- 新增页面 -->
    {if $add}
          <form method="post" name="add">         
            <dl>            
                <dd>导航名称:<input name="nav_name" type="text" class="text"/>(*不得小于2位或者大于20位)</dd>
                <dd>导航信息:<textarea name="nav_info"></textarea>(*描述不得大于200位)</dd>
                <dd><input name="send" type="submit" onclick="return checkNav()" class="submit" value="新增导航"/>　[ <a href="{$prev_url}">返回列表</a> ]</dd>
            </dl>
        </form>
    {/if}
<!-- 新增子导航 -->      
    {if $addchild}
          <form method="post" name="add">
          <input type="hidden" name="id" value="{$prev_id}"/>
          <input type="hidden" name="prev_url" value="{$prev_url}"/>
            <dl> 
                <dd>上一级导航:{$prev_name}</dd>           
                <dd>导航名称:<input name="nav_name" type="text" class="text"/>(*不得小于2位或者大于20位)</dd>
                <dd>导航信息:<textarea name="nav_info"></textarea>(*描述不得大于200位)</dd>
                <dd><input name="send" type="submit" onclick="return checkNav()" class="submit" value="新增子导航"/>　[ <a href="{$prev_url}">返回列表</a> ]</dd>
            </dl>
        </form>
    {/if}

</body>
</html>