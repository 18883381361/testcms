<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css"/>
<script type="text/javascript" src=../js/admin_manage.js></script>
</head>
<body id="main">    
    <p>内容管理&gt;&gt;友情链接&gt;&gt;<strong id="title">{$title}</strong></p>
    
    <ol>
        <li><a href="link.inc.php?action=show" class="selected">友情链接列表</a></li>
        <li><a href="link.inc.php?action=add">新增友情链接</a></li>
    
    {if $update}
        <li><a href="link.inc.php?action=update" class="selected">修改友情链接</a></li>
    {/if}
    </ol>
<!--显示友情链接列表 -->
    {if $show}
        <table cellspacing="0">
            <tr><th>编号</th><th>网站名称</th><th>网址地址</th><th>Logo地址</th><th>站长名</th><th>类型</th><th>状态</th><th>操作</th></tr>
            {if $AllLink}
            <form method="post" action="nav.inc.php?action=sort">
            {foreach $AllLink(key,value)}
            <tr>
                <td><script type="text/javascript">document.write({@key+1}+{$pagesize});</script></td>
                <td>{@value->webname}</td>
                <td title="{@value->fullweburl}"><a href="{@value->fullweburl}" target="_blank">{@value->weburl}</a></td>
                <td title="{@value->fulllogourl}"><a href="../{@value->fulllogourl}" target="_blank">{@value->logourl}</a></td>
                <td>{@value->user}</td>
                <td>{@value->type}</td>
                <td>{@value->state}</td>
                <td><a href="link.inc.php?action=update&id={@value->id}">修改</a> | <a href="link.inc.php?action=delete&id={@value->id}" onclick="return confirm('你真的要删除该友情链接吗?')?true:false">删除</a></td>
            </tr>
            {/foreach}
            </form>
            {else}
                <tr><td colspan=8>对不起，没有任何数据</td></tr>
            {/if}
        </table>
        <div id="page"><p>{$page}</p></div>
    {/if}   
    <!-- 修改页面 -->
    {if $update}
        <form method="post" name="add" action="?action=update">
        <input type="hidden" name="id" value="{$update_id}"/>
        <input type="hidden" name="prev_url" value="{$prev_url}"/>
        		<dl>
        			<dd>网站类型：<input type="radio" name="type" onclick="link(1)" value="1" {$text_type} /> 文字链接
        									<input type="radio" name="type" onclick="link(2)" value="2" {$logo_type}/> Logo链接
        			</dd>
        			<dd>网站名称：<input type="text" class="text" name="webname" value="{$webname}"/> <span class="red">[必填]</span> ( * 网站名称不能为空，不大于20位 )</dd>
        			<dd>网站地址：<input type="text" class="text" name="weburl" value="{$weburl}"/> <span class="red">[必填]</span> ( *  网站地址不能为空，不大于100位 )</dd>
        			<dd id="logo" {$logo}>Logo地址：<input type="text" class="text" name="logourl" value="{$logourl}"/> <span class="red">[必填]</span> ( * Logo地址不能为空，不大于100位 )</dd>
        			<dd>站 长 名：<input type="text" class="text" name="user" value="{$user}"/></dd>
        			<dd><input type="submit" class="submit" name="send" onclick="return checkLink();" value="修改友情链接" /></dd>
        		</dl>
        </form>
    {/if}
    
    <!-- 新增页面 -->
    {if $add}
          <form method="post" name="add">         
            <input type="hidden" value="1" name="state" />
        		<dl>
        			<dd>网站类型：<input type="radio" name="type" onclick="link(1)" value="1" checked="checked" /> 文字链接
        									<input type="radio" name="type" onclick="link(2)" value="2" /> Logo链接
        			</dd>
        			<dd>网站名称：<input type="text" class="text" name="webname" /> <span class="red">[必填]</span> ( * 网站名称不能为空，不大于20位 )</dd>
        			<dd>网站地址：<input type="text" class="text" name="weburl" /> <span class="red">[必填]</span> ( *  网站地址不能为空，不大于100位 )</dd>
        			<dd id="logo" style="display:none;">Logo地址：<input type="text" class="text" name="logourl" /> <span class="red">[必填]</span> ( * Logo地址不能为空，不大于100位 )</dd>
        			<dd>站 长 名：<input type="text" class="text" name="user" /></dd>
        			<dd><input type="submit" class="submit" name="send" onclick="return checkLink();" value="申请友情链接" /></dd>
        		</dl>
        </form>
    {/if}
</body>
</html>