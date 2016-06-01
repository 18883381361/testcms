<!-- <script type="text/javascript" src="ckeditor/ckeditor.js"></script> -->
<!-- <textarea id="TextArea1" name="content" class="ckeditor"></textarea> -->
<?php 
  /*   $path= $_SERVER['REQUEST_URI'];
    $par=parse_url($path);
    if(isset($par['query'])){
        parse_str($par['query'],$query);
        unset($query['page']);
        $url=$par['path'].'?'.http_build_query($query);
        echo $url;
    } */

    $string=$_SERVER['SCRIPT_NAME'];
    $array=explode('/', $string);
    $n=explode('.', $array[count($array)-1]);
    echo $n[0].'.tpl';
    //print_r($par);
?>
