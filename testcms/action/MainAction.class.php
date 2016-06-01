<?php 
    //控制器类
    class MainAction extends Action{
        public function __construct(&$tpl){
            parent::__construct($tpl);
        }
        public function action(){
          if($_GET['action']==deleteCache){
              if(!in_array('2', $_SESSION['admin']['premission'])) Tool::alertBack('您没有管理缓存的权限');
              $this->deleteCache();
          }
          $this->cacheNum();
        }
       //统计缓存目录文件数
       private function cacheNum(){
           $dir=ROOT_PATH.'cache';
           $num= sizeof(scandir($dir))-2;
           $this->tpl->assign('cacheNum',$num);
       }
       //清理缓存
       private function deleteCache(){
           $dir=ROOT_PATH.'cache';
           if(!$dh=opendir($dir)) return;
           while (!!$obj=readdir($dh)){
               if($obj=='.' || $obj=='..') continue;
               unlink($dir.'/'.$obj);
           }
           closedir($dh);
           Tool::alertBack('清理缓存成功');
       }
    }
?>