<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$webname}</title>
<link rel="stylesheet" type="text/css" href="style/details.css" />
<link rel="stylesheet" type="text/css" href="style/basic.css" />
<script type="text/javascript" src="config/static.php?id={$id}&type=details"></script>
<script type="text/javascript" src="js/front.js"></script>
</head>

<body>
{include file='header.tpl'}
<div id="details">
    <h2>当前位置&gt;{$nav}</h2>
    <h3>{$listTitle}</h3>
    <div class="d1">时间:{$date}　来源:{$source}　作者:{$author}　点击量:{$count}</div>
    <div class="d2">{$info}</div>
    <div class="d3">{$content}</div>
    <div class="d4">TAG标签：{$tag}
                            </div>
    <h2 class="commend">最新评论<a href="feedback.php?cid={$id}" target="_blank">共有<span>{$commendTotal}</span>条评论</a></h2>
    
    {if $newCommend}
        <div class="d6">
        {foreach $newCommend(key,value)}
         
            <dl>
                <dt><img alt="" src="images/{@value->face}"></dt>
                <dd>[<span class="username">{@value->username}</span>]<span class="date">{@value->date} 发表</span></dd>
                <dd class="content">[{@value->manner}]{@value->content}</dd>
                <dd class="manner"><a href="?cid={@value->cid}&id={@value->id}&type=support" target="_blank">[{@value->support}]支持</a>　<a href="?cid={@value->cid}&id={@value->id}&type=oppose" target="_blank">[{@value->oppose}]反对</a></dd>
            </dl>
        {/foreach}
        </div>
    {else}
    <p class="no">暂无评论</p>
    {/if}
	<div class="d5">
	<form method="post" action="feedback.php?cid={$id}" target="_blank" name="commend">
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
    <div id="page">{$page}</div>
   
</div>
<div id="sidbar">
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