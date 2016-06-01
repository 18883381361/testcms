<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>new title</title>
<script type="text/javascript" src="config/static.php?type=header"></script>
</head>
<body>
<div id="top">
    <script type="text/javascript" src="js/adver_text.js"></script>
    <?php echo $this->vars['header']?>
</div>
<div id="header">
    <div class="logo"><a href="###"><img alt="广告图" src="images/logo.png"></a></div>
    <div class="adver"><script type="text/javascript" src="js/adver_header.js"></script></div>
</div>
<div id="nav">
    <ul>
        <li><a href="./">首页</a></li>
        <?php if($this->vars['frontNav']){ ?>
            <?php foreach($this->vars['frontNav'] as $key=>$value){ ?>
        <li><a href="list.php?id=<?php echo $value->id ?>"><?php echo $value->nav_name ?></a></li>
            <?php } ?>
        <?php } ?>
    </ul>
</div>
<div id="search">
    <form action="search.php" method="get" target="_blank">
        <select name="type" class="select">
            <option selected="selected" value="1">按标题</option>
            <option value="2">按关键字</option>
        </select>
        <input type="text" name="inputkeyword" class="text"></input>
        <input type="submit" value="搜索" class="submit"></input>
    </form>
    <ul>
        <li><strong>TAG标签:</strong></li>
        <?php if($this->vars['tagList']){ ?>
            <?php foreach($this->vars['tagList'] as $key=>$value){ ?>
        <li><a href="###"><?php echo $value->tagname ?>(<?php echo $value->count ?>)</a></li>
            <?php } ?>
        <?php } ?>
    </ul>
</div>
</body>
</html>