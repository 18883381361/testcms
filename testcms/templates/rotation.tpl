<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css"/>
<script type="text/javascript" src=../js/admin_manage.js></script>
</head>
<body id="main">    
    <p>内容管理&gt;&gt;首页轮播器&gt;&gt;<strong id="title">{$title}</strong></p>
    
    <ol>
        <li><a href="rotation.inc.php?action=show" class="selected">轮播器列表</a></li>
        <li><a href="rotation.inc.php?action=add">新增轮播器</a></li>
    
    {if $update}
        <li><a href="rotation.inc.php?action=update" class="selected">修改轮播器</a></li>
    {/if}
    </ol>
<!--显示轮播列表 -->
    {if $show}
        <table cellspacing="0">
            <tr><th>编号</th><th>标题</th><th>链接</th><th>是否首页轮播</th><th>操作</th></tr>
            {if $AllRotation}
            <form method="post" action="nav.inc.php?action=sort">
            {foreach $AllRotation(key,value)}
            <tr>
                <td><script type="text/javascript">document.write({@key+1}+{$pagesize});</script></td>
                <td>{@value->title}</td>
                <td title="{@value->full}"><a href="{@value->full}" target="_blank">{@value->link}</a></td>
                <td>{@value->state}</td>
                <td><a href="rotation.inc.php?action=update&id={@value->id}">查看并修改</a> | <a href="rotation.inc.php?action=delete&id={@value->id}" onclick="return confirm('你真的要删除该轮播图吗?')?true:false">删除</a></td>
            </tr>
            {/foreach}
            <tr><td colspan="5" style="color:blue;">( * 每当任何轮播器的操作或变动，都必须点击[生成xml文件]，来更新首页轮播器 )</td></tr>
	        <tr><td colspan="5"><input type="button" value="生成xml文件" onclick="javascript:location.href='?action=xml'" /></td></tr>
            </form>
            {else}
                <tr><td colspan=5>对不起，没有任何数据</td></tr>
            {/if}
        </table>
       
        <p class="add">[<a href="rotation.inc.php?action=add">新增轮播图</a>]</p>
        <div id="page"><p>{$page}</p></div>
    {/if}   
    <!-- 修改页面 -->
    {if $update}
        <form method="post" name="add" action="?action=update">
        <input type="hidden" name="id" value="{$update_id}"/>
        <input type="hidden" name="prev_url" value="{$prev_url}"/>
           <dl>            
                <dd>轮 播 图： 　 <input type="text" name="thumb" readonly="readonly" class="text" id="url" value="{$thumb}"/>
                          <input type="button" value="上传轮播图" onclick="centerWindow('../config/upfile.php?type=rotation','upfile','400','200')" />( * 最佳大小是268X193或以上，必须是jpg,gif,png，并且200k内)
			     <dd><img name="pic" style="display:black;" src="{$thumb}" id="showimg"/> </dd>
                </dd>
                <dd>链　　接：  　<input type="text" name="link" class="text" value="{$link}"/> (* 不得为空，站内站外连接均可)</dd>
                <dd>标　　题：  　<input type="text" name="title" class="text" value="{$titler}"/> (* 不得大于20位！)</dd>
                <dd>描述信息：　<textarea name="info">{$info}</textarea> (* 描述不得大于200位！)</dd>
                <dd><input name="send" type="submit" onclick="return checkRotationAdd()" class="submit" value="修改轮播器"/>　[ <a href="{$prev_url}">返回列表</a> ]</dd>
            </dl>
        </form>
    {/if}
    
    <!-- 新增页面 -->
    {if $add}
          <form method="post" name="add">         
            <dl>            
                <dd>轮 播 图： 　 <input type="text" name="thumb" readonly="readonly" class="text" id="url"/>
                          <input type="button" value="上传轮播图" onclick="centerWindow('../config/upfile.php?type=rotation','upfile','400','200')" />( * 最佳大小是268X193或以上，必须是jpg,gif,png，并且200k内)
						  <img name="pic" style="display:none;" id="showimg"/> 
                </dd>
                <dd>链　　接：  　<input type="text" name="link" class="text" /> (* 不得为空，站内站外连接均可)</dd>
                <dd>标　　题：  　<input type="text" name="title" class="text" /> (* 不得大于20位！)</dd>
                <dd>描述信息：　<textarea name="info"></textarea> (* 描述不得大于200位！)</dd>
                <dd><input name="send" type="submit" onclick="return checkRotationAdd()" class="submit" value="新增轮播器"/>　[ <a href="{$prev_url}">返回列表</a> ]</dd>
            </dl>
        </form>
    {/if}
</body>
</html>