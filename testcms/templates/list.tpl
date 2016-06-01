<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>首页--<!--{webname}--></title>
<link rel="stylesheet" type="text/css" href="style/list.css" />
<link rel="stylesheet" type="text/css" href="style/basic.css" />
<script type="text/javascript" src="js/front.js"></script>
</head>
<body>
{include file='header.tpl'}
<div id="list">
    <h2>当前位置&gt;{$nav}</h2>
    {if $frontlist}
    {foreach $frontlist(key,value)}
    <script type="text/javascript" src="config/static.php?id={@value->id}&type=list"></script>
    <dl>
        <dt><a href="details?id={@value->id}" target="_blank"><img alt="" src="{@value->thumb}"></a></dt>
        <dd>[<strong>{@value->nav_name}</strong>] <a href="details.php?id={@value->id}" target="_blank">{@value->title}</a></dd>
		<dd>日期：{@value->date} 点击率：{@value->count} 关键字:[{@value->keyword}]</dd>
		<dd>{@value->info}</dd>
    </dl>
    {/foreach}
    {else}
        <p>暂无数据</p>
    {/if}
    <div id="page">
        <p>{$page}</p>
    </div>
</div>
<div id="sidbar">
    <div class="nav">
    <h2>子栏目列表</h2>
    <ul >
        {if $childNav}
            {foreach $childNav(key,value)}
                <li><a href="list.php?id={@value->id}">{@value->nav_name}</a></li>
            {/foreach}
        {else}
            <p>暂无子栏目<p>
        {/if}
    </ul>
    </div>
    <div class="right">
		<h2>本月本类推荐</h2>
		<ul>
		{if $MonthNavRec}
    		{foreach $MonthNavRec(key,value)}
    			<li><em>{@value->date}</em><a href="details.php?id={@value->id}" target="_blank">{@value->title}</a></li>
    		{/foreach}
		{/if}	
		</ul>
	</div>
	<div class="right">
		<h2>本月本类热点</h2>
		<ul>
		{if $MonthNavHot}
    		{foreach $MonthNavHot(key,value)}
    			<li><em>{@value->date}</em><a href="details.php?id={@value->id}" target="_blank">{@value->title}</a></li>
    		{/foreach}
		{/if}
		
		</ul>
	</div>
	<div class="right">
		<h2>本月本类图文</h2>
		<ul>
		{if $MonthNavPic}
    		{foreach $MonthNavPic(key,value)}
    			<li><em>{@value->date}</em><a href="details.php?id={@value->id}" target="_blank">{@value->title}</a></li>
    		{/foreach}
		{/if}
		</ul>
	</div>
</div>
{include file='footer.tpl'}
</body>
</html>