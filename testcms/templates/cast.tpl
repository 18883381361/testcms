<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$webname}</title>
<link rel="stylesheet" type="text/css" href="style/cast.css" />
<link rel="stylesheet" type="text/css" href="style/basic.css" />
<script type="text/javascript" src="js/front.js"></script>
</head>
<body>
{include file='header.tpl'}
<div id="cast">
    <h2>投票结果</h2>
    
    <table cellspacing="1">
        <caption>{$titlev}</caption>    
        <tr><th>投票项目</th><th>图示比例</th><th>百分比</th><th>得票数</th></tr>
        {if $item}
            {foreach $item(key,value)}
                <tr><td>{@value->title}</td><td style="text-align:left;padding:0 0 0 5px;width:{$width}px"><img src="images/b{@value->picnum}.jpg" style="height:21px;width:{@value->picwidth}px;"/></td><td>{@value->percent}</td><td>{@value->count}</td></tr>
            {/foreach}
        {/if}
    </table>
</div>
{include file='footer.tpl'}
</body>
</html>