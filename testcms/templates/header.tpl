<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>new title</title>
<script type="text/javascript" src="config/static.php?type=header"></script>
</head>
<body>
<div id="top">
    <script type="text/javascript" src="js/adver_text.js"></script>
    {$header}
</div>
<div id="header">
    <div class="logo"><a href="###"><img alt="广告图" src="images/logo.png"></a></div>
    <div class="adver"><script type="text/javascript" src="js/adver_header.js"></script></div>
</div>
<div id="nav">
    <ul>
        <li><a href="./">首页</a></li>
        {if $frontNav}
            {foreach $frontNav(key,value)}
        <li><a href="list.php?id={@value->id}">{@value->nav_name}</a></li>
            {/foreach}
        {/if}
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
        {if $tagList}
            {foreach $tagList(key,value)}
        <li><a href="###">{@value->tagname}({@value->count})</a></li>
            {/foreach}
        {/if}
    </ul>
</div>
</body>
</html>