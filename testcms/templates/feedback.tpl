<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$webname}</title>
<link rel="stylesheet" type="text/css" href="style/feedback.css" />
<link rel="stylesheet" type="text/css" href="style/basic.css" />
<script type="text/javascript" src="js/front.js"></script>
</head>
<body>
{include file='header.tpl'}
<div id="commend">
    <div class="info">
    <h3><a href="details.php?id={$cid}" target="_blank">{$title}</a></h3>
    <span class="info">{$info}</span>
    <p class="line"/>
    {if $hot}
        {foreach $hot(key,value)}
            <dl>
                <dt><img alt="" src="images/{@value->face}"></dt>
                <dd>[<span class="username">{@value->username}</span>]　<img alt="热" src="images/hot.gif"><span class="date">{@value->date} 发表</span></dd>
                <dd class="content">[{@value->manner}]{@value->content}</dd>
                <dd class="manner"><a href="?cid={@value->cid}&id={@value->id}&type=support">[{@value->support}]支持</a>　<a href="?cid={@value->cid}&id={@value->id}&type=oppose">[{@value->oppose}]反对</a></dd>
            </dl>
        {/foreach}
    {/if}
    <p class="new">最新评论</p>
    <p class="line"/>
    {if $commend}
        {foreach $commend(key,value)}
            <dl>
                <dt><img alt="" src="images/{@value->face}"></dt>
                <dd>[<span class="username">{@value->username}</span>]<span class="date">{@value->date} 发表</span></dd>
                <dd class="content">[{@value->manner}]{@value->content}</dd>
                <dd class="manner"><a href="?cid={@value->cid}&id={@value->id}&type=support">[{@value->support}]支持</a>　<a href="?cid={@value->cid}&id={@value->id}&type=oppose">[{@value->oppose}]反对</a></dd>
            </dl>
        {/foreach}
    {else}
    <p class="no">暂无评论</p>
    {/if}
    </div>
    <div id="page"><p>{$page}<p></div>
    <div class="d5">
	<form method="post" action="feedback.php?cid={$id}" name="commend">
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
</div>
<div id="sidbar">
	<div class="right">
		<h2>热评文档</h2>
		<ul>
		{if $contentMostCommend}
		  {foreach $contentMostCommend(key,value)}
			<li><a href="details.php?id={@value->id}" target="_blank">{@value->title}</a></li>
          {/foreach}
        {/if}
		</ul>
	</div>
</div>
{include file='footer.tpl'}
</body>
</html>