<?php 
    class Tool{
        //弹窗跳转
        static public function alertLocation($info,$url){
            if(!empty($info)){
                echo "<script type='text/javascript'>alert('$info');location.href='$url';</script>";
                exit();
            }else{
                header("Location:$url");
            }
            
        }
        //转换成tpl文件
        static public function toTpl(){
            $string=$_SERVER['SCRIPT_NAME'];
            $array=explode('/', $string);
            $n=explode('.', $array[count($array)-1]);
            return  $n[0];
        }
        //弹窗返回
        static public function alertBack($info){
            echo "<script type='text/javascript'>alert('$info');history.back();</script>";
            exit();
        }
        //弹窗关闭
        static public function alertClose($info){
            echo "<script type='text/javascript'>alert('$info');close();</script>";
            exit();
        }
        //清理session
        static public function cleanSession(){
            if(session_start()){
                session_destroy();
            }
        }
        //对html进行转义
        static public function htmlString($data){
            if(is_array($data)){
                $string= array();
                foreach ($data as $key=>$value){
                    $string[$key]=Tool::htmlString($value);
                }
            }elseif(is_object($data)){
                $string=new stdClass();
                foreach ($data as $key=>$value){
                    $string->$key=Tool::htmlString($value);
                }
            }else{
                $string=htmlspecialchars($data);
            } 
            return $string;  
        }
        //对输入数据库的数据进行过滤
        static public function addString($data){
            $_gpc = get_magic_quotes_gpc();            
           	if (!$_gpc) {
             		return addslashes($data);
             	} else {
             		return $data;
             	} 
            }
        
            
            
        //弹窗赋值关闭(上传专用)
        static public function alertOpenerClose($_info,$_path) {
            echo "<script type='text/javascript'>alert('$_info');</script>";
//             echo "<script type='text/javascript'>opener.document.content.thumbnail.value='$_path';</script>";
//             echo "<script type='text/javascript'>opener.document.content.pic.style.display='block';</script>";
//             echo "<script type='text/javascript'>opener.document.content.pic.src='$_path';</script>";
            echo "<script type='text/javascript'>window.opener.document.getElementById('url').value='$_path';</script>";
            echo "<script type='text/javascript'>window.opener.document.getElementById('showimg').style.display='block';</script>";
            echo "<script type='text/javascript'>window.opener.document.getElementById('showimg').src='$_path';</script>";
            echo "<script type='text/javascript'>window.close();</script>";
            exit();
        }
        
        //字符串截取
        static public function subStr($_object,$_field,$_length,$_encoding) {
            if ($_object) {
                foreach ($_object as $_value) {
                    if (mb_strlen($_value->$_field,$_encoding) > $_length) {
                        $_value->$_field = mb_substr($_value->$_field,0,$_length,$_encoding).'...';
                    }
                }
            }
            return $_object;
        }
        
        
    }
?>