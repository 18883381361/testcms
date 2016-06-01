<?php 
    //控制器类
    class SystemAction extends Action{
        public function __construct(&$tpl){
            parent::__construct($tpl, new SystemModel());
        }
        public function action(){
           $this->show();
        }
        private function show(){
            if (isset($_POST['send'])) {
                $this->model->webname = $_POST['webname'];
                $this->model->page_size = $_POST['page_size'];
                $this->model->article_size = $_POST['article_size'];
                $this->model->nav_size = $_POST['nav_size'];
                $this->model->updir = $_POST['updir'];
                $this->model->ro_time = $_POST['ro_time'];
                $this->model->ro_num = $_POST['ro_num'];
                $this->model->adver_text_num = $_POST['adver_text_num'];
                $this->model->adver_pic_num = $_POST['adver_pic_num'];
                if ($this->model->setSystem()) {
                    $br="\r\n";
                    $progfile.="<?php".$br;
                    
                    $progfile.="//定义数据库".$br;
                    $progfile.="define('DB_HOST', 'localhost');".$br;
                    $progfile.="define('DB_USER', 'root');".$br;
                    $progfile.="define('DB_PWD', '063095aa');".$br;
                    $progfile.="define('DB_NAME', 'cms');".$br;
                    
                    $progfile.=$br;
                    
                    $progfile.="define('WEBNAME','".$this->model->webname."');//网站名字".$br;
                    $progfile.="define('PAGESIZE','".$this->model->page_size."');//定义每页条数".$br;
                    $progfile.="define('ARTICLESIZE','".$this->model->article_size."');//定义每页条数".$br;
                    $progfile.="define('PREV_URL',\$_SERVER['HTTP_REFERER']);//上一页地址".$br;
                    $progfile.="define('NAVSIZE', '".$this->model->nav_size."');//前台显示的主导航个数".$br;
                    $progfile.="define('RO_TIME', '".$this->model->ro_time."');//轮播图变化时间".$br;
                    $progfile.="define('RO_NUM', '".$this->model->ro_num."');//轮播图个数".$br;
                    $progfile.="define('UPDIR', '".$this->model->updir."');//上传图片文件夹".$br;
                    $progfile.="define('ADVER_TEXT_NUM', '".$this->model->adver_text_num."');//每次最多循环的文字广告个数".$br;
                    $progfile.="define('ADVER_PIC_NUM', '".$this->model->adver_pic_num."');//每次最多循环的图片广告个数".$br;
                    $progfile.=$br;
                    $progfile.="//不可修改的配置文件".$br;
                    $progfile.="define('MARK', ROOT_PATH.'/images/yc.png');//水印图片".$br;
                    $progfile.="//存放模版文件夹".$br;
                    $progfile.="define(TPL_DIR,ROOT_PATH.'templates\\\\');".$br;
                    $progfile.="//编译文件夹".$br;
                    $progfile.="define(TPL_C_DIR,ROOT_PATH.'templates_c\\\\');".$br;
                    $progfile.="//缓存文件夹".$br;
                    $progfile.="define(CACHE,ROOT_PATH.'cache\\\\');".$br;
                    $progfile.="?>".$br;
                    
                    if(!file_put_contents('../config/profile.inc.php', $progfile)) Tool::alertBack('修改配置文件出错');
                    Tool::alertLocation('配置文件修改成功', 'system.inc.php'); 
                }
            }
            $_object = $this->model->getSystem();
			$this->tpl->assign('webname',$_object->webname);
			$this->tpl->assign('page_size',$_object->page_size);
			$this->tpl->assign('article_size',$_object->article_size);
			$this->tpl->assign('nav_size',$_object->nav_size);
			$this->tpl->assign('updir',$_object->updir);
			$this->tpl->assign('ro_time',$_object->ro_time);
			$this->tpl->assign('ro_num',$_object->ro_num);
			$this->tpl->assign('adver_text_num',$_object->adver_text_num);
			$this->tpl->assign('adver_pic_num',$_object->adver_pic_num);
            $this->tpl->assign('show',true);
            $this->tpl->assign('title','配置信息');
            //$this->tpl->assign('level', $this->model->getAllLevel());
           // $this->tpl->assign('total', $this->model->getTotal());
        }
       
    }
?>