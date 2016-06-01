<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$webname}</title>
<link rel="stylesheet" type="text/css" href="style/register.css" />
<link rel="stylesheet" type="text/css" href="style/basic.css" />
<script type="text/javascript" src="js/front.js"></script>
</head>
<body>
{include file='header.tpl'}
<!-- 友情链接申请加入界面 -->
{if $frontadd}
<div id="reg">
    <h2>申请加入链接</h2>
	<form method="post" name="friendlink" action="?action=frontadd">
		<input type="hidden" value="0" name="state" />
		<dl>
			<dd>网站类型：<input type="radio" name="type" onclick="link(1)" value="1" checked="checked" /> 文字链接
									<input type="radio" name="type" onclick="link(2)" value="2" /> Logo链接
			</dd>
			<dd>网站名称：<input type="text" class="text" name="webname" /> <span class="red">[必填]</span> ( * 网站名称不能为空，不大于20位 )</dd>
			<dd>网站地址：<input type="text" class="text" name="weburl" /> <span class="red">[必填]</span> ( *  网站地址不能为空，不大于100位 )</dd>
			<dd id="logo" style="display:none;">Logo地址：<input type="text" class="text" name="logourl" /> <span class="red">[必填]</span> ( * Logo地址不能为空，不大于100位 )</dd>
			<dd>站 长 名：<input type="text" class="text" name="user" /></dd>
			<dd>验 证 码：<input type="text" class="text" name="code" /> <span class="red">[必填]</span><img src="config/code.php" onclick="freshCode()" class="code" id="code"/></dd>
			<dd><input type="submit" class="submit" name="send" onclick="return checkLink();" value="申请友情链接" /></dd>
		</dl>
	</form>
</div>
{/if}

<!-- 显示所有链接 -->
{if $frontshow}
    <div id="reg">
        <h2>所有链接</h2>
        <h3>文字链接</h3>        
        <div>
            {if $allText}
                {foreach $allText(key,value)}
                    <a href="{@value->weburl}" target="_blank">{@value->webname}</a>
                {/foreach}
            {/if}
        </div>
        <h3>logo链接</h3>
        <div>
            {if $allLogo}
                {foreach $allLogo(key,value)}
                    <a href="{@value->weburl}" target="_blank" title="{@value->webname}"><img src="{@value->logourl}"/></a>
                {/foreach}
            {/if}
        </div>
    </div>
{/if}
{include file='footer.tpl'}
</body>
</html>