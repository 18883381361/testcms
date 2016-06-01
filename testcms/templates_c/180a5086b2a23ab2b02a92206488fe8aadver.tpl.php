<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css"/>
<script type="text/javascript" src=../js/admin_manage.js></script>
</head>
<body id="main">    
    <p>内容管理&gt;&gt;广告管理&gt;&gt;<strong id="title"><?php echo $this->vars['title']?></strong></p>
    
    <ol>
        <li><a href="adver.inc.php?action=show" class="selected">广告列表</a></li>
        <li><a href="adver.inc.php?action=add">新增广告</a></li>
    
    <?php if($this->vars['update']){ ?>
        <li><a href="adver.inc.php?action=update" class="selected">修改广告</a></li>
    <?php } ?>
    </ol>
<!--显示轮播列表 -->
    <?php if($this->vars['show']){ ?>
        <table cellspacing="0">
            <tr><th>编号</th><th>广告标题</th><th>广告链接</th><th>广告类型</th><th>是否前台广告</th><th>操作</th></tr>
            <?php if($this->vars['AllAdver']){ ?>
            <form method="post" action="nav.inc.php?action=sort">
            <?php foreach($this->vars['AllAdver'] as $key=>$value){ ?>
            <tr>
                <td><script type="text/javascript">document.write(<?php echo $key+1 ?>+<?php echo $this->vars['pagesize']?>);</script></td>
                <td><?php echo $value->title ?></td>
                <td title="<?php echo $value->full ?>"><a href="<?php echo $value->full ?>" target="_blank"><?php echo $value->link ?></a></td>
                <td><?php echo $value->type ?></td>
                <td><?php echo $value->state ?></td>
                <td><a href="adver.inc.php?action=update&id=<?php echo $value->id ?>">查看并修改</a> | <a href="adver.inc.php?action=delete&id=<?php echo $value->id ?>" onclick="return confirm('你真的要删除该广告吗?')?true:false">删除</a></td>
            </tr>
            <?php } ?>
            <tr><td colspan="6" style="color:blue;">( * 每当任何轮播器的操作或变动，都必须点击[生成js文件]，来更新首页广告)</td></tr>
	        <tr><td colspan="6">
	           <input type="button" value="生成文字广告js" onclick="javascript:location.href='?action=js&type=1'" />
	           <input type="button" value="生成头部广告js" onclick="javascript:location.href='?action=js&type=2'" />
	           <input type="button" value="生成侧栏广告js" onclick="javascript:location.href='?action=js&type=3'" />
	        </td></tr>
            </form>
            <?php }else{ ?>
                <tr><td colspan=5>对不起，没有任何数据</td></tr>
            <?php } ?>
        </table>
        <form method="get" action="?">
        <input type="hidden" name="action" value="show">
            <div id="page">
                <p><?php echo $this->vars['page']?>
                    <select name="type">
                        <option value="0" selected="selected">默认全部</option>
                        <option value="1">文字广告</option>
                        <option value="2">头部广告690x80</option>
                        <option value="3">侧栏广告270x200</option>
                    </select>
                    <input type="submit" value="查询"/>
                </p>
                
            </div>
        </form>
    <?php } ?>   
    <!-- 修改页面 -->
    <?php if($this->vars['update']){ ?>
        <form method="post" name="add" action="?action=update">
        <input type="hidden" name="id" value="<?php echo $this->vars['update_id']?>"/>
        <input type="hidden" name="prev_url" value="<?php echo $this->vars['prev_url']?>"/>
        <input type="hidden" id="adv" name='adv'/>       
            <dl>
                 <dd>广告类型：<input type="radio" name="type" onclick="adver(1)" value="1" <?php echo $this->vars['type1']?>/> 文字广告
									<input type="radio" name="type" onclick="adver(2)" value="2" <?php echo $this->vars['type2']?>/> 头部广告690x80
									<input type="radio" name="type" onclick="adver(3)" value="3" <?php echo $this->vars['type3']?>/> 侧栏广告270x200
			    </dd>           
                <dd <?php echo $this->vars['pic']?> id="adver">广告图片： <input type="text" name="thumb" readonly="readonly" class="text" id="url" value="<?php echo $this->vars['thumb']?>"/>
                          <span id="advertype"><?php echo $this->vars['advertype']?></span>( * 必须是jpg,gif,png，并且200k内)
                          </dd>
						  <dd><img name="pic" <?php echo $this->vars['pic']?> id="showimg" src="<?php echo $this->vars['thumb']?>"/> </dd>
                
                <dd>广告链接：  <input type="text" name="link" class="text" value="<?php echo $this->vars['link']?>"/> (* 不得为空，站内站外连接均可)</dd>
                <dd>广告标题：  <input type="text" name="title" class="text" value="<?php echo $this->vars['titler']?>"/> (* 不得大于20位！)</dd>
                <dd>描述信息： <textarea name="info"><?php echo $this->vars['info']?></textarea> (* 描述不得大于200位！)</dd>
                <dd><input name="send" type="submit" onclick="return checkAdverAdd()" class="submit" value="修改广告"/>　[ <a href="<?php echo $this->vars['prev_url']?>">返回列表</a> ]</dd>
            </dl>
        </form>
    <?php } ?>
    
    <!-- 新增页面 -->
    <?php if($this->vars['add']){ ?>
          <form method="post" name="add" action="?action=add"> 
          <input type="hidden" id="adv" name='adv'/>       
            <dl><dd>广告类型：<input type="radio" name="type" onclick="adver(1)" value="1" checked="checked" /> 文字广告
									<input type="radio" name="type" onclick="adver(2)" value="2" /> 头部广告690x80
									<input type="radio" name="type" onclick="adver(3)" value="3" /> 侧栏广告270x200
			    </dd>           
                <dd style="display:none;" id="adver">广告图片： <input type="text" name="thumb" readonly="readonly" class="text" id="url"/>
                          <span id="advertype"></span>( * 必须是jpg,gif,png，并且200k内)
						  <img name="pic" style="display:none;" id="showimg"/> 
                </dd>
                <dd>广告链接：  <input type="text" name="link" class="text" /> (* 不得为空，站内站外连接均可)</dd>
                <dd>广告标题：  <input type="text" name="title" class="text" /> (* 不得大于20位！)</dd>
                <dd>描述信息： <textarea name="info"></textarea> (* 描述不得大于200位！)</dd>
                <dd><input name="send" type="submit" onclick="return checkAdverAdd()" class="submit" value="新增广告"/>　[ <a href="<?php echo $this->vars['prev_url']?>">返回列表</a> ]</dd>
            </dl>
        </form>
    <?php } ?>
</body>
</html>