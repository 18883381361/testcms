<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->vars['webname']?></title>
<link rel="stylesheet" type="text/css" href="style/cast.css" />
<link rel="stylesheet" type="text/css" href="style/basic.css" />
<script type="text/javascript" src="js/front.js"></script>
</head>
<body>
<?php $tpl->create('header.tpl') ?>
<div id="cast">
    <h2>投票结果</h2>
    
    <table cellspacing="1">
        <caption><?php echo $this->vars['titlev']?></caption>    
        <tr><th>投票项目</th><th>图示比例</th><th>百分比</th><th>得票数</th></tr>
        <?php if($this->vars['item']){ ?>
            <?php foreach($this->vars['item'] as $key=>$value){ ?>
                <tr><td><?php echo $value->title ?></td><td style="text-align:left;padding:0 0 0 5px;width:<?php echo $this->vars['width']?>px"><img src="images/b<?php echo $value->picnum ?>.jpg" style="height:21px;width:<?php echo $value->picwidth ?>px;"/></td><td><?php echo $value->percent ?></td><td><?php echo $value->count ?></td></tr>
            <?php } ?>
        <?php } ?>
    </table>
</div>
<?php $tpl->create('footer.tpl') ?>
</body>
</html>