<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css"/>
<script type="text/javascript" src=../js/admin_manage.js></script>
</head>
<body id="main">    
    <p>管理首页&gt;&gt;管理员管理&gt;&gt;<strong id="title"><?php echo $this->vars['title']?></strong></p>
    
    <ol>
        <li><a href="manage.inc.php?action=show" class="selected">管理员列表</a></li>
        <li><a href="manage.inc.php?action=add">新增管理员</a></li>
    
    <?php if($this->vars['update']){ ?>
        <li><a href="manage.inc.php?action=update" class="selected">修改管理员</a></li>
    <?php } ?>
    </ol>
    <?php if($this->vars['show']){ ?>
        <table cellspacing="0">
            <tr><th>编号</th><th>用户名</th><th>等级</th><th>登录次数</th><th>最近登录时间</th><th>最近登录IP</th><th>操作</th></tr>
            <?php if($this->vars['total']){ ?>
            <?php foreach($this->vars['manage'] as $key=>$value){ ?>
            <tr>
                <td><script type="text/javascript">document.write(<?php echo $key+1 ?>+<?php echo $this->vars['pagesize']?>);</script></td>
                <td><?php echo $value->admin_user ?></td>
                <td><?php echo $value->level_name ?></td>
                <td><?php echo $value->login_count ?></td>
                <td><?php echo $value->last_time ?></td>
                <td><?php echo $value->last_ip ?></td>
                <td><a href="manage.inc.php?action=update&id=<?php echo $value->id ?>">修改</a> | <a href="manage.inc.php?action=delete&id=<?php echo $value->id ?>" onclick="return confirm('你真的要删除该管理员吗?')?true:false">删除</a></td>
            </tr>
            <?php } ?>
            <?php }else{ ?>
                <tr><td colspan=4>对不起，没有任何数据</td></tr>
            <?php } ?>
        </table>
        <p class="add">[<a href="manage.inc.php?action=add">新增管理员</a>]</p>
        <div id="page"><p><?php echo $this->vars['page']?></p></div>
    <?php } ?>
    <!-- 修改页面 -->
    <?php if($this->vars['update']){ ?>
        <input type="hidden" id="level" value="<?php echo $this->vars['update_level']?>"/>
        <form method="post" name="update">
        <input type="hidden" name="id" value="<?php echo $this->vars['update_id']?>"/>
        <input type="hidden" name="prev_url" value="<?php echo $this->vars['prev_url']?>"/>
            <dl>
                <dd>用户名:<input name="username" type="text" class="text" value="<?php echo $this->vars['update_user']?>"/>(*不得小于2位或者大于20位)</dd>
                <dd>密　码:<input name="password" type="password" class="text"/>(*留空则不修改)</dd>
                <dd>等　级:<select name="level" id="options">
                            <?php foreach($this->vars['alllevel'] as $key=>$value){ ?>
                            <option value="<?php echo $value->level ?>"><?php echo $value->level_name ?></option>
                            <?php } ?>
                         </select></dd>
                <dd><input name="send" type="submit" onclick="return checkManageUpdate()" class="submit" value="修改管理员"/>　[ <a href="<?php echo $this->vars['prev_url']?>">返回列表</a> ]</dd>
            </dl>
        </form>
    <?php } ?>
    
    <!-- 新增页面 -->
    <?php if($this->vars['add']){ ?>
          <form method="post" name="add">
            <dl>
                <dd>用 户 名:<input name="username" type="text" class="text"/> (*不得小于2位或者大于20位)</dd>
                <dd>密　　码:<input name="password" type="password" class="text"/> (*不得小于6位)</dd>
                <dd>密码确认:<input name="notpassword" type="password" class="text"/> (*必须同密码一致)</dd>
                <dd>等　级:<select name="level">
                            <?php foreach($this->vars['alllevel'] as $key=>$value){ ?>
                            <option value="<?php echo $value->level ?>"><?php echo $value->level_name ?></option>
                            <?php } ?>
                         </select></dd>
                <dd><input name="send" type="submit" class="submit" onclick="return checkManageAdd()" value="新增管理员"/>　[ <a href="<?php echo $this->vars['prev_url']?>">返回列表</a> ]</dd>
            </dl>
        </form>
    <?php } ?>

</body>
</html>