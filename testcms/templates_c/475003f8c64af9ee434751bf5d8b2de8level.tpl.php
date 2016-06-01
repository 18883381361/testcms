<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css"/>
<script type="text/javascript" src=../js/admin_manage.js></script>
</head>
<body id="main">    
    <p>管理首页&gt;&gt;等级管理&gt;&gt;<strong id="title"><?php echo $this->vars['title']?></strong></p>
    
    <ol>
        <li><a href="level.inc.php?action=show" class="selected">等级列表</a></li>
        <li><a href="level.inc.php?action=add">新增等级</a></li>
    
    <?php if($this->vars['update']){ ?>
        <li><a href="level.inc.php?action=update" class="selected">修改等级</a></li>
    <?php } ?>
    </ol>
    <?php if($this->vars['show']){ ?>
        <table cellspacing="0">
            <tr><th>等级</th><th>等级名称</th><th>等级信息</th><th>权限标识</th><th>操作</th></tr>
            <?php if($this->vars['total']){ ?>
            <?php foreach($this->vars['level'] as $key=>$value){ ?>
            <tr>
                <td><?php echo $value->level ?></td>
                <td><?php echo $value->level_name ?></td>
                <td><?php echo $value->level_info ?></td>
                <td><?php echo $value->premission ?></td>
                <td><a href="level.inc.php?action=update&id=<?php echo $value->id ?>">修改</a> | <a href="level.inc.php?action=delete&id=<?php echo $value->id ?>" onclick="return confirm('你真的要删除该等级吗?')?true:false">删除</a></td>
            </tr>
            <?php } ?>
            <?php }else{ ?>
                <tr><td colspan=4>对不起，没有任何数据</td></tr>
            <?php } ?>
        </table>
        <p class="add">[<a href="level.inc.php?action=add">新增等级</a>]</p>
    <?php } ?>
    <!-- 修改页面 -->
    <?php if($this->vars['update']){ ?>
        <form method="post" name="update">
        <input type="hidden" name="id" value="<?php echo $this->vars['update_id']?>"/>
            <dl>
               <dd>等　　级:<input name="level" type="text" class="text" value="<?php echo $this->vars['update_level']?>"/>(*必须位数字)</dd>
                <dd>等级名称:<input name="level_name" type="text" class="text" value="<?php echo $this->vars['update_level_name']?>"/>(*不得小于2位或者大于20位)</dd>
                <dd>等级信息:<textarea name="level_info"><?php echo $this->vars['update_level_info']?></textarea>(*描述不得大于200位)</dd>
                <dd style="width:29%;">
                    <?php if($this->vars['allPremission']){ ?>
                        <?php foreach($this->vars['allPremission'] as $key=>$value){ ?>
                            <input type="checkbox" value="<?php echo $value->id ?>" name="premission[]" <?php echo $value->check ?>><?php echo $value->name ?></input>
                        <?php } ?>
                    <?php } ?>
                </dd>
                <dd><input name="send" type="submit" onclick="return checkLevel()" class="submit" value="修改等级"/>　[ <a href="level.inc.php?action=show">返回列表</a> ]</dd>
            </dl>
        </form>
    <?php } ?>
    
    <!-- 新增页面 -->
    <?php if($this->vars['add']){ ?>
          <form method="post" name="add">
            <dl>
                <dd>等　　级:<input name="level" type="text" class="text"/>(*必须位数字)</dd>
                <dd>等级名称:<input name="level_name" type="text" class="text"/>(*不得小于2位或者大于20位)</dd>
                <dd>等级信息:<textarea name="level_info"></textarea>(*描述不得大于200位)</dd>
                <dd style="width:29%;">
                    <?php if($this->vars['allPremission']){ ?>
                        <?php foreach($this->vars['allPremission'] as $key=>$value){ ?>
                            <input type="checkbox" value="<?php echo $value->id ?>" name="premission[]"><?php echo $value->name ?></input>
                        <?php } ?>
                    <?php } ?>
                </dd>
                <dd><input name="send" type="submit" onclick="return checkLevel()" class="submit" value="新增等级"/>　[ <a href="level.inc.php?action=show">返回列表</a> ]</dd>
            </dl>
        </form>
    <?php } ?>

</body>
</html>