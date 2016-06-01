<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css"/>
<script type="text/javascript" src=../js/admin_manage.js></script>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
</head>
<body id="main">    
    <p>内容管理&gt;&gt;查看文档列表&gt;&gt;<strong id="title"><?php echo $this->vars['title']?></strong></p>
    
    <ol>
        <li><a href="content.inc.php?action=show" class="selected">文档列表</a></li>
        <li><a href="content.inc.php?action=add">新增文档</a></li>
    
    <?php if($this->vars['update']){ ?>
        <li><a href="content.inc.php?action=update" class="selected">修改文档</a></li>
    <?php } ?>
    </ol>
<!--显示文档列表 -->
    <?php if($this->vars['show']){ ?>
        <table cellspacing="0">
            <tr><th>编号</th><th>标题</th><th>属性</th><th>文档类别</th><th>浏览次数</th><th>发布时间</th><th>操作</th></tr>
            <?php if($this->vars['alllist']){ ?>
            <form method="post" action="nav.inc.php?action=sort">
            <?php foreach($this->vars['alllist'] as $key=>$value){ ?>
            <tr>
                <td><script type="text/javascript">document.write(<?php echo $key+1 ?>+<?php echo $this->vars['pagesize']?>);</script></td>
                <td><a href="../details.php?id=<?php echo $value->id ?>" target="_blank" title="<?php echo $value->t ?>"><?php echo $value->title ?></a></td>
                <td><?php echo $value->attr ?></td>
                <td><a href="?action=show&nav=<?php echo $value->nav ?>"><?php echo $value->nav_name ?></a></td>
                <td><?php echo $value->count ?></td>
                <td><?php echo $value->date ?></td>
                <td><a href="content.inc.php?action=update&id=<?php echo $value->id ?>">修改</a> | <a href="content.inc.php?action=delete&id=<?php echo $value->id ?>" onclick="return confirm('你真的要删除该文档吗?')?true:false">删除</a></td>
<!--                 <td><input type="text" name="sort[<?php echo $value->id ?>]" value="<?php echo $value->sort ?>" class="text"/></td> -->
            </tr>
            <?php } ?>
<!--             <tr><td></td><td></td><td></td><td></td><td></td><td><input type="submit" value="排序" name="send"/></td></tr> -->
            </form>
            <?php }else{ ?>
                <tr><td colspan=7>对不起，没有任何数据</td></tr>
            <?php } ?>
        </table>
        <form method="get" action="?">
        <input type="hidden" name="action" value="show"/>
            <div id="page">
                <p><?php echo $this->vars['page']?><select name="nav"><option value="">默认全部</option><?php echo $this->vars['nav_name']?></select>　<input type="submit" value="查询"/></p>
            </div>
        </form>
    <?php } ?>
  
    <!-- 修改页面 -->
    <?php if($this->vars['update']){ ?>
        <table cellspacing="0" class="content">
            <tr><th>发布一条新文档</th></tr>
            <form method="post" action="?action=update" name="update">
            <input type="hidden" name="id" value="<?php echo $this->vars['id']?>"/>
            <input type="hidden" name="prev_url" value="<?php echo $this->vars['prev_url']?>"/>
                <tr><td> 文档标题:　<input type="text" name="title" value="<?php echo $this->vars['listtitle']?>" class="text"/><span style="color: red">[必填]</span> ( * 标题2-50字符之间)<td></tr>
                <tr><td> 栏　　目:　<select name="nav"><option value="">请选择一个栏目类别</option><?php echo $this->vars['nav_name']?></select> <span style="color: red">[必选]</span><td></tr>
                <tr><td> 定义属性:　<?php echo $this->vars['attr']?>
                </td></tr>
                <tr><td> TAG标签:　<input type="text" name="tag" class="text" value="<?php echo $this->vars['tag']?>"/>( * 每个标签用','隔开，总长30位之内</td></tr>
                <tr><td> 关  键   字:　 <input type="text" name="keyword" class="text" value="<?php echo $this->vars['keyword']?>"/>( * 每个关键字用','隔开，总长30位之内)<td></tr>
                <tr><td> 缩  略   图:　 <input type="text" name="thumb" class="text" id="url" readonly="readonly" value="<?php echo $this->vars['thumb']?>"/>
                                 <input type="button" value="上传缩略图" onclick="centerWindow('../config/upfile.php?type=content','upfile','400','200')"/>( * 必须是jpg,gif,png，并且2M内)
                                 <img style="display: block" id="showimg" src="<?php echo $this->vars['thumb']?>"/>
                </td></tr>
                <tr><td> 文章来源:　<input type="text" name="source" class="text" value="<?php echo $this->vars['source']?>"/>( * 文章来源20位之内)</td></tr>                
                <tr><td> 作　　者:　<input type="text" value="<?php echo $this->vars['author']?>" readonly="readonly" name="author" class="text" value="<?php echo $this->vars['author']?>"/>( * 作者10位之内)</td></tr>
                <tr><td> 内容摘要:　<textarea class="textarea" name="info"><?php echo $this->vars['info']?></textarea>( * 内容摘要200之内)</td></tr>
                <tr class="editor"><td>　<textarea id="TextArea1" name="content" class="ckeditor"><?php echo $this->vars['content']?></textarea>
                </td></tr>
                <tr><td>评论选项:<?php echo $this->vars['commend']?>
                                                                           　　　　　　 浏览次数:<input type="text" name="count" value="<?php echo $this->vars['count']?>" />
                </td></tr>
                <tr><td>文档排序:　<select name="sort">
                                <?php echo $this->vars['sort']?>
                </select>
               　　　　　　　　　　 消费金币:<input type="text" name="gold" value="<?php echo $this->vars['gold']?>"/>
                </td></tr>
                <tr><td>阅读权限:　<select name="readlimit">
									<?php echo $this->vars['readlimit']?>
								</select>
				　　　　　　　　　　 标题颜色:<select name="color">
									<?php echo $this->vars['color']?>
								</select>
	            </td></tr>
                <tr><td><input name="send" type="submit" value="修改文档" onclick="return checkContentAdd()"/> <input type="reset" value="重置" /></td></tr>
            </form>
       </table>
        
    <?php } ?>
    
    <!-- 新增页面 -->
    <?php if($this->vars['add']){ ?> 
       <table cellspacing="0" class="content">
            <tr><th>发布一条新文档</th></tr>
            <form method="post" action="?action=add" name="add">
                <tr><td> 文档标题:　<input type="text" name="title" class="text"/><span style="color: red">[必填]</span> ( * 标题2-50字符之间)<td></tr>
                <tr><td> 栏　　目:　<select name="nav"><option value="">请选择一个栏目类别</option><?php echo $this->vars['nav_name']?></select> <span style="color: red">[必选]</span><td></tr>
                <tr><td> 定义属性:　<input type="checkbox" name="attr[]" value="头条"/>头条
                                <input type="checkbox" name="attr[]" value="推荐"/>推荐
                               <input type="checkbox" name="attr[]" value="加粗"/>加粗
                               <input type="checkbox" name="attr[]" value="跳转"/>跳转
                </td></tr>
                <tr><td> TAG标签:　<input type="text" name="tag" class="text"/>( * 每个标签用','隔开，总长30位之内</td></tr>
                <tr><td> 关  键   字:　 <input type="text" name="keyword" class="text"/>( * 每个关键字用','隔开，总长30位之内)<td></tr>
                <tr><td> 缩  略   图:　 <input type="text" name="thumb" class="text" id="url" readonly="readonly"/>
                                 <input type="button" value="上传缩略图" onclick="centerWindow('../config/upfile.php?type=content','upfile','400','200')"/>( * 必须是jpg,gif,png，并且2M内)
                                 <img style="display: none" id="showimg"/>
                </td></tr>
                <tr><td> 文章来源:　<input type="text" name="source" class="text"/>( * 文章来源20位之内)</td></tr>                
                <tr><td> 作　　者:　<input type="text" value="<?php echo $this->vars['author']?>" readonly="readonly" name="author" class="text"/>( * 作者10位之内)</td></tr>
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
        
    <?php } ?>


</body>
</html>