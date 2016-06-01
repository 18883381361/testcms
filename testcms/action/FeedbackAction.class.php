<?php 
    //控制器类
    class FeedbackAction extends Action{
        public function __construct(&$tpl){
            parent::__construct($tpl);
        }
       
        public function action(){
            $this->supportOrOppose();
            $this->showCommend();
            $this->addCommend();    
        }   
        
        //新增评论
        private function addCommend(){
            if (isset($_POST['send'])) {
                $url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                if($url==PREV_URL){
                    if(Validate::checkNull($_POST['content'])) Tool::alertBack('评论内容不得为空');
                    if(Validate::checkLength($_POST['content'], 255, 'max')) Tool::alertBack('评论内容不得大于255字');
                    if(Validate::checkLength($_POST['code'], 4, 'equal')) Tool::alertBack('验证码必须是4位');
                    if(Validate::checkSessionCode($_POST['code'])) Tool::alertBack('验证码有误');
                }else{
                    if(Validate::checkNull($_POST['content'])) Tool::alertClose('评论内容不得为空');
                    if(Validate::checkLength($_POST['content'], 255, 'max')) Tool::alertClose('评论内容不得大于255字');
                    if(Validate::checkLength($_POST['code'], 4, 'equal')) Tool::alertClose('验证码必须是4位');
                    if(Validate::checkSessionCode($_POST['code'])) Tool::alertClose('验证码有误');
                }
                parent::__construct($this->tpl, new CommendModel());
                if (isset($_COOKIE['user'])) {
                    $this->model->username = $_COOKIE['user'];
                } else {
                    $this->model->username = '游客';
                }
                $this->model->manner = $_POST['manner'];
                $this->model->content = $_POST['content'];
                $this->model->cid = $_GET['cid'];
                $this->model->addCommend() ? Tool::alertLocation('评论添加成功，请等待管理员审核！','feedback.php?cid='.$this->model->cid) : Tool::alertLocation('评论添加失败，请重新添加！','feedback.php?cid='.$this->model->cid);
            }
        }
        //显示评论
        private function showCommend(){
            if(isset($_GET['cid'])){                
                parent::__construct($this->tpl,new CommendModel());
                $this->model->id=$_GET['cid'];
                if(!is_numeric($this->model->id)){
                    Tool::alertBack('这篇文章不存在');
                }
                if(!$this->model->getOneList()) Tool::alertBack('这篇文章不存在');
                $this->model->cid=$_GET['cid'];
                 if(!!$total=$this->model->getTotal()){
                     parent::page($total,ARTICLESIZE);
                 }
                 if(!!$hot=$this->model->getHotCommend()){
                     foreach ($hot as $value){
                         switch ($value->manner){
                             case '-1':  $value->manner='反对';
                             break;
                             case '0' :  $value->manner='中立';
                             break;
                             case '1' :  $value->manner='支持';
                             break;
                         }
                         if($value->username=='游客'){
                             $value->face='00.gif';
                         }
                     }
                     $this->tpl->assign('hot',$hot);
                 }
                if(!!$contentMostCommend=$this->model->getContentMostCommend()){
                    $this->tpl->assign('contentMostCommend',$contentMostCommend);
                }
                if(!!$object=$this->model->getAllCommend()){
                    foreach ($object as $value){
                        switch ($value->manner){
                            case '-1':  $value->manner='反对';
                                        break;
                            case '0' :  $value->manner='中立';
                                        break;
                            case '1' :  $value->manner='支持';
                                        break;
                        }
                        if($value->username=='游客'){
                            $value->face='00.gif';
                        }
                    }
                    $this->tpl->assign('commend',$object);
                }
               
                $content=new ContentModel();
                $content->id=$_GET['cid'];
                $list=$content->getOneList();
                $this->tpl->assign('title',$list->title);
                $this->tpl->assign('info',$list->info);
                $this->tpl->assign('cid',$_GET['cid']);
            }
      
        }
        //更新支持和反对
        private function supportOrOppose(){
            if(isset($_GET['type'])){
                parent::__construct($this->tpl,new CommendModel());
                $this->model->cid=$_GET['cid'];
                $this->model->id=$_GET['id'];
                switch ($_GET['type']){
                    case 'support': $this->model->support();
                                    break;
                    case 'oppose' : $this->model->oppose();
                                    break;
                    default:    Tool::alertBack('非法操作');
                }
            }
        }
    }
?>