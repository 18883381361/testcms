<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css"/>
<script type="text/javascript" src=../js/admin_manage.js></script>
</head>
<body id="main">    
    <p>管理首页&gt;&gt;权限管理&gt;&gt;<strong id="title"><?php echo $this->vars['title']?></strong></p>
    
    <ol>
        <li><a href="premission.inc.php?action=show" class="selected">权限列表</a></li>
        <li><a href="premission.inc.php?action=add">新增权限</a></li>
    
    <?php if($this->vars['update']){ ?>
        <li><a href="premission.inc.php?action=update" class="selected">修改权限</a></li>
    <?php } ?>
    </ol>
<!--显示权限 -->
    <?php if($this->vars['show']){ ?>
        <table cellspacing="0">
            <tr><th>编号</th><th>权限名称</th><th>权限描述</th><th>操作</th></tr>
            <?php if($this->vars['premission']){ ?>
            <form method="post" action="nav.inc.php?action=sort">
            <?php foreach($this->vars['premission'] as $key=>$value){ ?>
            <tr>
                <td><script type="text/javascript">document.write(<?php echo $key+1 ?>+<?php echo $this->vars['pagesize']?>);</script></td>
                <td><?php echo $value->name ?></td>
                <td><?php echo $value->info ?></td>
                <td><a href="premission.inc.php?action=update&id=<?php echo $value->id ?>">修改</a> | <a href="premission.inc.php?action=delete&id=<?php echo $value->id ?>" onclick="return confirm('你真的要删除该权限吗?')?true:false">删除</a></td>
            </tr>
            <?php } ?>
            </form>
            <?php }else{ ?>
                <tr><td colspan=4>对不起，没有任何数据</td></tr>
            <?php } ?>
        </table>
        <div id="page"><p><?php echo $this->vars['page']?></p></div>
    <?php } ?>
   
    <!-- 修改页面 -->
    <?php if($this->vars['update']){ ?>
        <form method="post" name="update">
        <input type="hidden" name="id" value="<?php echo $this->vars['update_id']?>"/>
        <input type="hidden" name="prev_url" value="<?php echo $this->vars['prev_url']?>"/>
            <dl>
               <dd>权限名称:<input name="name" type="text" class="text" value="<?php echo $this->vars['name']?>"/>(*不得小于2位或者大于20位)</dd>
                <dd>权限描述:<textarea name="info"><?php echo $this->vars['info']?></textarea>(*描述不得大于200位)</dd>
                <dd><input name="send" type="submit" onclick="return checkPremission()" class="submit" value="修改权限"/>　[ <a href="<?php echo $this->vars['prev_url']?>">返回列表</a> ]</dd>
            </dl>
        </form>
    <?php } ?>
    
    <!-- 新增页面 -->
    <?php if($this->vars['add']){ ?>
          <form method="post" name="add">         
            <dl>            
                <dd>权限名称:<input name="name" type="text" class="text"/>(*不得小于2位或者大于20位)</dd>
                <dd>权限描述:<textarea name="info"></textarea>(*描述不得大于200位)</dd>
                <dd><input name="send" type="submit" onclick="return checkPremission()" class="submit" value="新增权限"/>　[ <a href="<?php echo $this->vars['prev_url']?>">返回列表</a> ]</dd>
            </dl>
        </form>
    <?php } ?>


</body>
</html>