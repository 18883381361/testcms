<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>首页--<?php echo $this->config['webname'] ?></title>
<link rel="stylesheet" type="text/css" href="style/list.css" />
<link rel="stylesheet" type="text/css" href="style/basic.css" />
<script type="text/javascript" src="js/front.js"></script>
</head>
<body>
<?php $tpl->create('header.tpl') ?>
<div id="list">
    <h2>当前位置&gt;<?php echo $this->vars['nav']?></h2>
    <?php if($this->vars['frontlist']){ ?>
    <?php foreach($this->vars['frontlist'] as $key=>$value){ ?>
    <script type="text/javascript" src="config/static.php?id=<?php echo $value->id ?>&type=list"></script>
    <dl>
        <dt><a href="details?id=<?php echo $value->id ?>" target="_blank"><img alt="" src="<?php echo $value->thumb ?>"></a></dt>
        <dd>[<strong><?php echo $value->nav_name ?></strong>] <a href="details.php?id=<?php echo $value->id ?>" target="_blank"><?php echo $value->title ?></a></dd>
		<dd>日期：<?php echo $value->date ?> 点击率：<?php echo $value->count ?> 关键字:[<?php echo $value->keyword ?>]</dd>
		<dd><?php echo $value->info ?></dd>
    </dl>
    <?php } ?>
    <?php }else{ ?>
        <p>暂无数据</p>
    <?php } ?>
    <div id="page">
        <p><?php echo $this->vars['page']?></p>
    </div>
</div>
<div id="sidbar">
    <div class="nav">
    <h2>子栏目列表</h2>
    <ul >
        <?php if($this->vars['childNav']){ ?>
            <?php foreach($this->vars['childNav'] as $key=>$value){ ?>
                <li><a href="list.php?id=<?php echo $value->id ?>"><?php echo $value->nav_name ?></a></li>
            <?php } ?>
        <?php }else{ ?>
            <p>暂无子栏目<p>
        <?php } ?>
    </ul>
    </div>
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