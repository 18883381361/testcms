<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->vars['webname']?></title>
<link rel="stylesheet" type="text/css" href="style/details.css" />
<link rel="stylesheet" type="text/css" href="style/basic.css" />
<script type="text/javascript" src="config/static.php?id=<?php echo $this->vars['id']?>&type=details"></script>
<script type="text/javascript" src="js/front.js"></script>
</head>

<body>
<?php $tpl->create('header.tpl') ?>
<div id="details">
    <h2>当前位置&gt;<?php echo $this->vars['nav']?></h2>
    <h3><?php echo $this->vars['listTitle']?></h3>
    <div class="d1">时间:<?php echo $this->vars['date']?>　来源:<?php echo $this->vars['source']?>　作者:<?php echo $this->vars['author']?>　点击量:<?php echo $this->vars['count']?></div>
    <div class="d2"><?php echo $this->vars['info']?></div>
    <div class="d3"><?php echo $this->vars['content']?></div>
    <div class="d4">TAG标签：<?php echo $this->vars['tag']?>
                            </div>
    <h2 class="commend">最新评论<a href="feedback.php?cid=<?php echo $this->vars['id']?>" target="_blank">共有<span><?php echo $this->vars['commendTotal']?></span>条评论</a></h2>
    
    <?php if($this->vars['newCommend']){ ?>
        <div class="d6">
        <?php foreach($this->vars['newCommend'] as $key=>$value){ ?>
         
            <dl>
                <dt><img alt="" src="images/<?php echo $value->face ?>"></dt>
                <dd>[<span class="username"><?php echo $value->username ?></span>]<span class="date"><?php echo $value->date ?> 发表</span></dd>
                <dd class="content">[<?php echo $value->manner ?>]<?php echo $value->content ?></dd>
                <dd class="manner"><a href="?cid=<?php echo $value->cid ?>&id=<?php echo $value->id ?>&type=support" target="_blank">[<?php echo $value->support ?>]支持</a>　<a href="?cid=<?php echo $value->cid ?>&id=<?php echo $value->id ?>&type=oppose" target="_blank">[<?php echo $value->oppose ?>]反对</a></dd>
            </dl>
        <?php } ?>
        </div>
    <?php }else{ ?>
    <p class="no">暂无评论</p>
    <?php } ?>
	<div class="d5">
	<form method="post" action="feedback.php?cid=<?php echo $this->vars['id']?>" target="_blank" name="commend">
		<p>你对本文的态度：<input type="radio" name="manner" value="1" checked="checked" /> 支持
									<input type="radio" name="manner" value="0" /> 中立
									<input type="radio" name="manner" value="-1" /> 反对
		</p>
		<p class="red">根据互联网规则，不要发表关于政治、反动、色情之类的评论。</p>
		<p><textarea name="content"></textarea></p>
		<p>
			 验证码：<input type="text" class="text" name="code" />
			 <img src="config/code.php" onclick="freshCode()" class="code" id="code"/> 
			 <input type="submit" class="submit" name="send" value="提交评论" onclick="return checkCommend()"/>
		</p>
	</form>
	</div>
    <div id="page"><?php echo $this->vars['page']?></div>
   
</div>
<div id="sidbar">
    <div class="right">
		<h2>本月本类推荐</h2>
		<ul>
		<?php if($this->vars['MonthNavRec']){ ?>
    		<?php foreach($this->vars['MonthNavRec'] as $key=>$value){ ?>
    			<li><em><?php echo $value->date ?></em><a href="details.php?id=<?php echo $value->id ?>" target="_blank"><?php echo $value->title ?></a></li>
    		<?php } ?>
		<?php } ?>	
		</ul>
	</div>
	<div class="right">
		<h2>本月本类热点</h2>
		<ul>
		<?php if($this->vars['MonthNavHot']){ ?>
    		<?php foreach($this->vars['MonthNavHot'] as $key=>$value){ ?>
    			<li><em><?php echo $value->date ?></em><a href="details.php?id=<?php echo $value->id ?>" target="_blank"><?php echo $value->title ?></a></li>
    		<?php } ?>
		<?php } ?>
		
		</ul>
	</div>
	<div class="right">
		<h2>本月本类图文</h2>
		<ul>
		<?php if($this->vars['MonthNavPic']){ ?>
    		<?php foreach($this->vars['MonthNavPic'] as $key=>$value){ ?>
    			<li><em><?php echo $value->date ?></em><a href="details.php?id=<?php echo $value->id ?>" target="_blank"><?php echo $value->title ?></a></li>
    		<?php } ?>
		<?php } ?>
		</ul>
	</div>
</div>
<?php $tpl->create('footer.tpl') ?>
</body>
</html>