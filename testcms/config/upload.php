<?php
require substr(dirname(__FILE__),0,-7).'/init.inc.php';
if (isset($_POST['send'])) {
    switch ($_POST['type']){
        case 'content': $width=150;
                        $height=100;
                        $info='缩略图上传成功';
                        break;
        case 'rotation':$width=268;
                        $height=193;
                        $info='轮播图上传成功';
                        break; 
        case 'adver' :
                        switch ($_POST['size']){
                            
                            case '690*80':  $width=690;
                                            $height=80;
                                            $info='头部广告上传成功';
                                            break;
                            case '270*200': $width=270;
                                            $height=200;
                                            $info='侧栏广告上传成功';
                                            break;
                            default:Tool::alertBack('非法操作哈');
                        }
                        break;
        default:    Tool::alertBack('非法操作');
    }
	$_fileupload = new FileUpload('pic',$_POST['MAX_FILE_SIZE']);
 	$_path = $_fileupload->getPath();
 	//echo $_path;
 	$_img = new Image($_path);
 	$_img->thumb($width,$height);		//1-100
 	$_img->out();
 	Tool::alertOpenerClose($info,$_path);
} else {
	Tool::alertBack('警告：文件过大或者其他未知错误导致浏览器崩溃！');
}
?>