<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>new title</title>
</head>
<body>
<div id="link">
    <h2><em><a href="friendlink.php?action=frontshow" target="_blank">所有链接</a>　|　<a href="friendlink.php?action=frontadd" target="_blank">申请加入</a></em>友情链接</h2>
    <ul>
        <?php if($this->vars['text_link']){ ?>
            <?php foreach($this->vars['text_link'] as $key=>$value){ ?>
		<li><a href="<?php echo $value->weburl ?>" target="_blank"><?php echo $value->webname ?></a></li>
		    <?php } ?>
		<?php } ?>
	</ul>
	<dl>
	   <?php if($this->vars['logo_link']){ ?>
            <?php foreach($this->vars['logo_link'] as $key=>$value){ ?>
		<dd><a href="<?php echo $value->weburl ?>" target="_blank"><img src="<?php echo $value->logourl ?>" alt="<?php echo $value->webname ?>" /></a></dd>
	        <?php } ?>
	   <?php } ?>
	</dl>
</div>
<div id="footer">
    <p>Powered by <span>YC60.COM</span> (C) 2004-2011 DesDev Inc.</p>
	<p>Copyright (C) 2004-2011 YC60CMS. <span>瓢城Web俱乐部</span> 版权所有</p>
</div>
</body>
</html>