<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css"/>
<script type="text/javascript" src=../js/admin_manage.js></script>
</head>
<body id="main">    
    <p>内容管理&gt;&gt;调查投票管理&gt;&gt;<strong id="title">{$title}</strong></p>
    
    <ol>
        <li><a href="vote.inc.php?action=show" class="selected">投票主题列表</a></li>
        <li><a href="vote.inc.php?action=add">新增投票主题</a></li>
    
    {if $update}
        <li><a href="vote.inc.php?action=update" class="selected">修改投票</a></li>
    {/if}
    {if $addchild}
        <li><a href="vote.inc.php?action=addchild" class="selected">新增投票项目</a></li>
    {/if}
    {if $showchild}
        <li><a href="vote.inc.php?action=showchild" class="selected">查看投票项目</a></li>
    {/if}
    </ol>
<!--显示投票主题 -->
    {if $show}
        <table cellspacing="0">
            <tr><th>编号</th><th>投票主题</th><th>投票项目</th><th>是否前台首选</th><th>参与人数</th><th>操作</th></tr>
            {if $vote}
            <form method="post" action="nav.inc.php?action=sort">
            {foreach $vote(key,value)}
            <tr>
                <td><script type="text/javascript">document.write({@key+1}+{$pagesize});</script></td>
                <td>{@value->title}</td>
                <td><a href="vote.inc.php?action=showchild&id={@value->id}">查看</a> | <a href="vote.inc.php?action=addchild&id={@value->id}" >增加项目</a></td>
                <td>{@value->state}</td>
                <td>{@value->pcount}</td>
                <td><a href="vote.inc.php?action=update&id={@value->id}">修改</a> | <a href="vote.inc.php?action=delete&id={@value->id}" onclick="return confirm('你真的要删除该投票主题吗?')?true:false">删除</a></td>
<!--                 <td><input type="text" name="sort[{@value->id}]" value="{@value->sort}" class="text"/></td> -->
            </tr>
            {/foreach}
<!--             <tr><td></td><td></td><td></td><td></td><td></td><td><input type="submit" value="排序" name="send"/></td></tr> -->
            </form>
            {else}
                <tr><td colspan=5>对不起，没有任何数据</td></tr>
            {/if}
        </table>
        <div id="page"><p>{$page}</p></div>
    {/if}
    <!--显示投票项目-->
    {if $showchild}
        <table cellspacing="0">
            <tr><th>编号</th><th>投票项目</th><th>项目信息</th><th>得票数</th><th>操作</th></tr>
            {if $votechild}
             <form method="post" action="nav.inc.php?action=sort">
            {foreach $votechild(key,value)}
            <tr>
                <td><script type="text/javascript">document.write({@key+1}+{$pagesize});</script></td>
                <td>{@value->title}</td>
                <td>{@value->info}</td>
                <td>{@value->count}</td>
                <td><a href="vote.inc.php?action=update&id={@value->id}">修改</a> | <a href="vote.inc.php?action=delete&id={@value->id}" onclick="return confirm('你真的要删除该项目吗?')?true:false">删除</a></td>
<!--                 <td><input type="text" name="sort[{@value->id}]" value="{@value->sort}" class="text"/></td> -->
            </tr>
            {/foreach}
<!--             <tr><td></td><td></td><td></td><td></td><td></td><td><input type="submit" value="排序" name="send"/></td></tr> -->
            </form>
            {else}
                <tr><td colspan=4>对不起，没有任何数据</td></tr>
            {/if}
                            <tr><td colspan=4>本项目隶属于　<strong>{$prev_name}</strong>　[ <a href="vote.inc.php?action=addchild&id={$prev_id}">增加此主题项目</a> ]　[ <a href="{$prev_url}">返回列表</a> ]</td></tr>
        </table>
        <div id="page"><p>{$page}</p></div>
    {/if}
    <!-- 修改页面 -->
    {if $update}
        <form method="post" name="update" action="?action=update">
        <input type="hidden" name="id" value="{$update_id}"/>
        <input type="hidden" name="prev_url" value="{$prev_url}"/>
            <dl>
               <dd>投票标题:<input name="title" type="text" class="text" value="{$titlev}"/>(*不得小于2位或者大于20位)</dd>
                <dd>标题描述:<textarea name="info">{$info}</textarea>(*描述不得大于200位)</dd>
                <dd><input name="send" type="submit" onclick="return checkVote()" class="submit" value="修改投票"/>　[ <a href="{$prev_url}">返回列表</a> ]</dd>
            </dl>
        </form>
    {/if}
    
    <!-- 新增页面 -->
    {if $add}
          <form method="post" name="add">         
            <dl>            
                <dd>投票主题:<input name="title" type="text" class="text"/>(*不得小于2位或者大于20位)</dd>
                <dd>主题描述:<textarea name="info"></textarea>(*描述不得大于200位)</dd>
                <dd><input name="send" type="submit" onclick="return checkVote()" class="submit" value="新增投票主题"/>　[ <a href="{$prev_url}">返回列表</a> ]</dd>
            </dl>
        </form>
    {/if}
<!-- 新增投票项目 -->      
    {if $addchild}
          <form method="post" name="add" action="?action=addchild">
          <input type="hidden" name="id" value="{$prev_id}"/>
          <input type="hidden" name="prev_url" value="{$prev_url}"/>
            <dl> 
                <dd>投票主题:{$prev_name}</dd>           
                <dd>投票项目:<input name="title" type="text" class="text"/>(*不得小于2位或者大于20位)</dd>
                <dd>项目信息:<textarea name="info"></textarea>(*描述不得大于200位)</dd>
                <dd><input name="send" type="submit" onclick="return checkVote()" class="submit" value="新增投票项目"/>　[ <a href="{$prev_url}">返回列表</a> ]</dd>
            </dl>
        </form>
    {/if}

</body>
</html>