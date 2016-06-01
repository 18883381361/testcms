<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$webname}</title>
<link rel="stylesheet" type="text/css" href="style/index.css" />
<link rel="stylesheet" type="text/css" href="style/basic.css" />
<script type="text/javascript" src="js/front.js"></script>
<script type="text/javascript" src="config/static.php?type=index"></script>
</head>
<body>
{include file='header.tpl'}
<div id="user">
    {if $cache}
        {$member}
    {else}
        {if $login}
        <h2>会员登录</h2>
        <form method="post" action="register.php?action=login" name="login">
            <dl>
                <dd>用户名:<input type="text" name="username" class="text" ></input></dd>
                <dd>密　码:<input type="password" name="password" class="text"></input></dd>
                <dd>验证码:<input type="text" name="code" class="code"></input><img alt="验证码" src="config/code.php" id="code" onclick="freshCode()"></dd>
                <dd><input type="submit" name="send" onclick="return checkLogin()" value="登录" class="submit"/> <a href="register.php?action=reg">注册会员</a> <a href="###">忘记密码?</a></dd>
            </dl>
        </form>
        {else}
        <h2>会员信息</h2>
        <div class="a">您好,<strong>{$username}</strong> 欢迎光临</div>
        <div class="b">
            <dl class="a"><img src="images/{$face}" alt="头像"/></dl>
            <dl class="b">
                <dd><a href="###">个人中心</a></dd>
                <dd><a href="###">我的评论</a></dd>
                <dd><a href="register.php?action=logout">退出登录</a></dd>
            </dl>
        </div>
        {/if}
    {/if}
    <h3>最近登录的会员 ────────────</h3>
    {if $lastLoginUser}
    {foreach $lastLoginUser(key,value)}
    <dl class="user">
        <dt><img alt="会员" src="images/{@value->face}"></dt>
        <dd>{@value->username}</dd>
    </dl>
    {/foreach}
    {/if}
</div>
<div id="news">
    <h3><a href="details.php?id={$id}" target="_blank">{$NewOneTopTitle}</a></h3>
	<p>核心提示：{$NewOneTopInfo}...<a href="details.php?id={$id}" target="_blank">[查看全文]</a></p>
	
	   
	<p class="link1">
	{if $NewTop}
	   {foreach $NewTop(key,value)}  
		<a href="details.php?id={@value->id}" target="_blank">{@value->title}</a>{@value->line}
	   {/foreach}
	{/if}
	<p/>
	<ul>
	{if $NewDate}
	   {foreach $NewDate(key,value)}
		<li><em>{@value->date}</em><a href="details.php?id={@value->id}" target="_blank">{@value->title}</a></li>
	   {/foreach}
	{/if}
	</ul>
</div>
<div id="pic">
    <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" id="scriptmain" name="scriptmain" codebase="http://download.macromedia.com/pub/shockwave/cabs/
	flash/swflash.cab#version=6,0,29,0" width="268" height="193">
	      <param name="movie" value="images/lbxml.swf">
	      <param name="quality" value="high">
	      <param name="scale" value="noscale">
	      <param name="LOOP" value="false">
	      <param name="menu" value="false">
	      <param name="wmode" value="transparent">
	      <embed src="images/lbxml.swf" width="268" height="193" loop="false" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" salign="T" name="scriptmain" menu="false" wmode="transparent">
	</object>
</div>
<div id="rec">
    <h2>特别推荐</h2>
	<ul>
		{if $NewRec}
    		{foreach $NewRec(key,value)}
    			<li><em>{@value->date}</em><a href="details.php?id={@value->id}" target="_blank">{@value->title}</a></li>
    		{/foreach}
		{/if}
	</ul>
</div>
<div id="sidebar-right">
    <div class="adver"><script type="text/javascript" src="js/adver_sidbar.js"></script></div>
    <div class="hot">
        <h2>本月热点</h2>      
		<ul>
		{if $NewHot}
    		{foreach $NewHot(key,value)}
    			<li><em>{@value->date}</em><a href="details.php?id={@value->id}" target="_blank">{@value->title}</a></li>
    		{/foreach}
		{/if}
		</ul>
    </div>
    <div class="comm">
        <h2>本月评论</h2>
        <ul>
		{if $NewCom}
    		{foreach $NewCom(key,value)}
    			<li><em>{@value->date}</em><a href="details.php?id={@value->id}" target="_blank">{@value->title}</a></li>
    		{/foreach}
		{/if}
		</ul>
    </div>
    <div class="vote">
        <h2>调查投票</h2>
        <h3>{$votetitle}</h3>
		<form method="post" action="cast.php?id={$id}" target="_blank">
		    {if $voteItem}
		          {foreach $voteItem(key,value)}
            			<label><input type="radio" name="vote" value="{@value->id}"/> {@value->title}</label>
            	  {/foreach}
            	  <p><input type="submit" value="投票" name="send" /> <input type="button" value="查看" onclick="javascript:window.open('cast.php?id={$id}');"/></p>
		          
		    {/if}
		</form>
    </div>
</div>
<div id="picnews">
    <h2>图文资讯</h2>
    {if $NewPic}
        {foreach $NewPic(key,value)}
            <dl>
                <dt><a href="details.php?id={@value->id}" target="_blank"><img alt="图文资讯" src="{@value->thumb}"></a></dt>
                <dd><a href="details.php?id={@value->id}" target="_blank">{@value->title}</a></dd>
            </dl>	
        {/foreach}
    {/if}
</div>
<div id="newslist">
    {if $NavTop4}
        {foreach $NavTop4(key,value)}
            <div class="list top">
                <h2><em><a href="list.php?id={@value->id}" target="_blank">更多</a></em>{@value->nav_name}</h2>
                <ul>{for @value->list(key,value)}
        			<li><em>06-04</em><a href="###">{@value->title}</a></li>
        			{/for}
        		</ul>
            </div>
        {/foreach}
    {/if}
</div>
{include file='footer.tpl'}
</body>
</html>