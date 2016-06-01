<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css"/>
<script type="text/javascript" src=../js/admin_manage.js></script>
</head>
<body id="main">    
    <p>内容管理&gt;&gt;首页轮播器&gt;&gt;<strong id="title"><?php echo $this->vars['title']?></strong></p>
    
    <ol>
        <li><a href="rotation.inc.php?action=show" class="selected">轮播器列表</a></li>
        <li><a href="rotation.inc.php?action=add">新增轮播器</a></li>
    
    <?php if($this->vars['update']){ ?>
        <li><a href="rotation.inc.php?action=update" class="selected">修改轮播器</a></li>
    <?php } ?>
    </ol>
<!--显示轮播列表 -->
    <?php if($this->vars['show']){ ?>
        <table cellspacing="0">
            <tr><th>编号</th><th>标题</th><th>链接</th><th>是否首页轮播</th><th>操作</th></tr>
            <?php if($this->vars['AllRotation']){ ?>
            <form method="post" action="nav.inc.php?action=sort">
            <?php foreach($this->vars['AllRotation'] as $key=>$value){ ?>
            <tr>
                <td><script type="text/javascript">document.write(<?php echo $key+1 ?>+<?php echo $this->vars['pagesize']?>);</script></td>
                <td><?php echo $value->title ?></td>
                <td title="<?php echo $value->full ?>"><a href="<?php echo $value->full ?>" target="_blank"><?php echo $value->link ?></a></td>
                <td><?php echo $value->state ?></td>
                <td><a href="rotation.inc.php?action=update&id=<?php echo $value->id ?>">查看并修改</a> | <a href="rotation.inc.php?action=delete&id=<?php echo $value->id ?>" onclick="return confirm('你真的要删除该轮播图吗?')?true:false">删除</a></td>
            </tr>
            <?php } ?>
            <tr><td colspan="5" style="color:blue;">( * 每当任何轮播器的操作或变动，都必须点击[生成xml文件]，来更新首页轮播器 )</td></tr>
	        <tr><td colspan="5"><input type="button" value="生成xml文件" onclick="javascript:location.href='?action=xml'" /></td></tr>
            </form>
            <?php }else{ ?>
                <tr><td colspan=5>对不起，没有任何数据</td></tr>
            <?php } ?>
        </table>
       
        <p class="add">[<a href="rotation.inc.php?action=add">新增轮播图</a>]</p>
        <div id="page"><p><?php echo $this->vars['page']?></p></div>
    <?php } ?>   
    <!-- 修改页面 -->
    <?php if($this->vars['update']){ ?>
        <form method="post" name="add" action="?action=update">
        <input type="hidden" name="id" value="<?php echo $this->vars['update_id']?>"/>
        <input type="hidden" name="prev_url" value="<?php echo $this->vars['prev_url']?>"/>
           <dl>            
                <dd>轮 播 图： 　 <input type="text" name="thumb" readonly="readonly" class="text" id="url" value="<?php echo $this->vars['thumb']?>"/>
                          <input type="button" value="上传轮播图" onclick="centerWindow('../config/upfile.php?type=rotation','upfile','400','200')" />( * 最佳大小是268X193或以上，必须是jpg,gif,png，并且200k内)
			     <dd><img name="pic" style="display:black;" src="<?php echo $this->vars['thumb']?>" id="showimg"/> </dd>
                </dd>
                <dd>链　　接：  　<input type="text" name="link" class="text" value="<?php echo $this->vars['link']?>"/> (* 不得为空，站内站外连接均可)</dd>
                <dd>标　　题：  　<input type="text" name="title" class="text" value="<?php echo $this->vars['titler']?>"/> (* 不得大于20位！)</dd>
                <dd>描述信息：　<textarea name="info"><?php echo $this->vars['info']?></textarea> (* 描述不得大于200位！)</dd>
                <dd><input name="send" type="submit" onclick="return checkRotationAdd()" class="submit" value="修改轮播器"/>　[ <a href="<?php echo $this->vars['prev_url']?>">返回列表</a> ]</dd>
            </dl>
        </form>
    <?php } ?>
    
    <!-- 新增页面 -->
    <?php if($this->vars['add']){ ?>
          <form method="post" name="add">         
            <dl>            
                <dd>轮 播 图： 　 <input type="text" name="thumb" readonly="readonly" class="text" id="url"/>
                          <input type="button" value="上传轮播图" onclick="centerWindow('../config/upfile.php?type=rotation','upfile','400','200')" />( * 最佳大小是268X193或以上，必须是jpg,gif,png，并且200k内)
						  <img name="pic" style="display:none;" id="showimg"/> 
                </dd>
                <dd>链　　接：  　<input type="text" name="link" class="text" /> (* 不得为空，站内站外连接均可)</dd>
                <dd>标　　题：  　<input type="text" name="title" class="text" /> (* 不得大于20位！)</dd>
                <dd>描述信息：　<textarea name="info"></textarea> (* 描述不得大于200位！)</dd>
                <dd><input name="send" type="submit" onclick="return checkRotationAdd()" class="submit" value="新增轮播器"/>　[ <a href="<?php echo $this->vars['prev_url']?>">返回列表</a> ]</dd>
            </dl>
        </form>
    <?php } ?>
</body>
</html>