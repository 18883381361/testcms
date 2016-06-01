<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css"/>
<script type="text/javascript" src=../js/admin_manage.js></script>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
</head>
<body id="main">    
    <p>内容管理&gt;&gt;管理评论审核&gt;&gt;<strong id="title">{$title}</strong></p>
    
    <ol>
        <li><a href="content.inc.php?action=show" class="selected">评论列表</a></li>
    </ol>
<!--显示文档列表 -->
    {if $show}
        <table cellspacing="0">
            <tr><th>编号</th><th>评论内容</th><th>评论者</th><th>所属文档</th><th>状态</th><th>批审</th><th>操作</th></tr>
            {if $allCommend}
            <form method="post" action="commend.inc.php?action=state">
            {foreach $allCommend(key,value)}
            <tr>
                <td><script type="text/javascript">document.write({@key+1}+{$pagesize});</script></td>
                <td><a href="../details.php?id={@value->id}" target="_blank" title="{@value->full}">{@value->content}</a></td>
                <td>{@value->username}</td>
                <td><a href="../details.php?id={@value->cid}" target="_blank" title="{@value->title}">查看</a></td>
                <td>{@value->state}</td>
                <td><input type="text" name="state[{@value->id}]" value="{@value->s}" class="text"/></td>
                <td><a href="commend.inc.php?action=delete&id={@value->id}" onclick="return confirm('你真的要删除该评论吗?')?true:false">删除</a></td>
<!--                 <td><input type="text" name="sort[{@value->id}]" value="{@value->sort}" class="text"/></td> -->
            </tr>
            {/foreach}
             <tr><td></td><td></td><td></td><td></td><td></td><td><input type="submit" value="批审" name="send"/></td><td></td></tr> 
            </form>
            {else}
                <tr><td colspan=7>对不起，没有任何数据</td></tr>
            {/if}
        </table>
        <form method="get" action="?">
        <input type="hidden" name="action" value="show"/>
            <div id="page">
                <p>{$page}<select name="nav"><option value="">默认全部</option>{$nav_name}</select>　<input type="submit" value="查询"/></p>
            </div>
        </form>
    {/if}
  
    <!-- 修改页面 -->
    {if $update}
        <table cellspacing="0" class="content">
            <tr><th>发布一条新文档</th></tr>
            <form method="post" action="?action=update" name="update">
            <input type="hidden" name="id" value="{$id}"/>
            <input type="hidden" name="prev_url" value="{$prev_url}"/>
                <tr><td> 文档标题:　<input type="text" name="title" value="{$listtitle}" class="text"/><span style="color: red">[必填]</span> ( * 标题2-50字符之间)<td></tr>
                <tr><td> 栏　　目:　<select name="nav"><option value="">请选择一个栏目类别</option>{$nav_name}</select> <span style="color: red">[必选]</span><td></tr>
                <tr><td> 定义属性:　{$attr}
                </td></tr>
                <tr><td> TAG标签:　<input type="text" name="tag" class="text" value="{$tag}"/>( * 每个标签用','隔开，总长30位之内</td></tr>
                <tr><td> 关  键   字:　 <input type="text" name="keyword" class="text" value="{$keyword}"/>( * 每个关键字用','隔开，总长30位之内)<td></tr>
                <tr><td> 缩  略   图:　 <input type="text" name="thumb" class="text" id="url" readonly="readonly" value="{$thumb}"/>
                                 <input type="button" value="上传缩略图" onclick="centerWindow('../templates/upfile.html','upfile','400','200')"/>( * 必须是jpg,gif,png，并且2M内)
                                 <img style="display: block" id="showimg" src="{$thumb}"/>
                </td></tr>
                <tr><td> 文章来源:　<input type="text" name="source" class="text" value="{$source}"/>( * 文章来源20位之内)</td></tr>                
                <tr><td> 作　　者:　<input type="text" value="{$author}" readonly="readonly" name="author" class="text" value="{$author}"/>( * 作者10位之内)</td></tr>
                <tr><td> 内容摘要:　<textarea class="textarea" name="info">{$info}</textarea>( * 内容摘要200之内)</td></tr>
                <tr class="editor"><td>　<textarea id="TextArea1" name="content" class="ckeditor">{$content}</textarea>
                </td></tr>
                <tr><td>评论选项:{$commend}
                                                                           　　　　　　 浏览次数:<input type="text" name="count" value="{$count}" />
                </td></tr>
                <tr><td>文档排序:　<select name="sort">
                                {$sort}
                </select>
               　　　　　　　　　　 消费金币:<input type="text" name="gold" value="{$gold}"/>
                </td></tr>
                <tr><td>阅读权限:　<select name="readlimit">
									{$readlimit}
								</select>
				　　　　　　　　　　 标题颜色:<select name="color">
									{$color}
								</select>
	            </td></tr>
                <tr><td><input name="send" type="submit" value="修改文档" onclick="return checkContentAdd()"/> <input type="reset" value="重置" /></td></tr>
            </form>
       </table>
        
    {/if}
    
    <!-- 新增页面 -->
    {if $add} 
       <table cellspacing="0" class="content">
            <tr><th>发布一条新文档</th></tr>
            <form method="post" action="?action=add" name="add">
                <tr><td> 文档标题:　<input type="text" name="title" class="text"/><span style="color: red">[必填]</span> ( * 标题2-50字符之间)<td></tr>
                <tr><td> 栏　　目:　<select name="nav"><option value="">请选择一个栏目类别</option>{$nav_name}</select> <span style="color: red">[必选]</span><td></tr>
                <tr><td> 定义属性:　<input type="checkbox" name="attr[]" value="头条"/>头条
                                <input type="checkbox" name="attr[]" value="推荐"/>推荐
                               <input type="checkbox" name="attr[]" value="加粗"/>加粗
                               <input type="checkbox" name="attr[]" value="跳转"/>跳转
                </td></tr>
                <tr><td> TAG标签:　<input type="text" name="tag" class="text"/>( * 每个标签用','隔开，总长30位之内</td></tr>
                <tr><td> 关  键   字:　 <input type="text" name="keyword" class="text"/>( * 每个关键字用','隔开，总长30位之内)<td></tr>
                <tr><td> 缩  略   图:　 <input type="text" name="thumb" class="text" id="url" readonly="readonly"/>
                                 <input type="button" value="上传缩略图" onclick="centerWindow('../templates/upfile.html','upfile','400','200')"/>( * 必须是jpg,gif,png，并且2M内)
                                 <img style="display: none" id="showimg"/>
                </td></tr>
                <tr><td> 文章来源:　<input type="text" name="source" class="text"/>( * 文章来源20位之内)</td></tr>                
                <tr><td> 作　　者:　<input type="text" value="{$author}" readonly="readonly" name="author" class="text"/>( * 作者10位之内)</td></tr>
                <tr><td> 内容摘要:　<textarea class="textarea" name="info"></textarea>( * 内容摘要200之内)</td></tr>
                <tr class="editor"><td>　<textarea id="TextArea1" name="content" class="ckeditor"></textarea>
                </td></tr>
                <tr><td>评论选项:<input type="radio" name="commend" value="1" checked="checked"/>允许评论
                                <input type="radio" name="commend" value="0"/>禁止评论
                                                                           　　　　　　 浏览次数:<input type="text" name="count" value="100" />
                </td></tr>
                <tr><td>文档排序:　<select name="sort">
                                <option value="0">默认排序</option>
                                <option value="1">置顶一天</option>
                                <option value="2">置顶一周</option>
                                <option value="3">置顶一月</option>
                                <option value="4">置顶一年</option>
                </select>
               　　　　　　　　　　 消费金币:<input type="text" name="gold" value="0" />
                </td></tr>
                <tr><td>阅读权限:　<select name="readlimit">
									<option value="0">开放浏览</option>
									<option value="1">初级会员</option>
									<option value="2">中级会员</option>
									<option value="3">高级会员</option>
									<option value="4">VIP会员</option>
								</select>
				　　　　　　　　　　 标题颜色:<select name="color">
									<option>默认颜色</option>
									<option value="red" style="color:red;">红色</option>
									<option value="blue" style="color:blue;">蓝色</option>
									<option value="orange" style="color:orange;">橙色</option>
								</select>
	            </td></tr>
                <tr><td><input name="send" type="submit" value="发布文档" onclick="return checkContentAdd()"/> <input type="reset" value="重置" /></td></tr>
            </form>
       </table>
        
    {/if}


</body>
</html>