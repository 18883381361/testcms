<?php 
    //控制器类
    class VoteAction extends Action{
        public function __construct(&$tpl){
            parent::__construct($tpl, new VoteModel());           
            $this->tpl->assign('prev_url',PREV_URL);                   
        }
        public function action(){            
            switch ($_GET['action']){
                case 'show' :
                    $this->show();
                    break;
                case 'add' :
                    $this->add();                    
                    break;
                case 'update' :
                    $this->update();
                    break;
                case 'delete' :                   
                    $this->delete();
                    break;
                case 'addchild' :
                    $this->addchild();                  
                    break;
                case 'updatechild' :
                    $this->updatechild();
                    break;
                case 'showchild' :
                    $this->showchild();
                    break;
                case 'state' :
                    $this->state();
                    break;
                default:
                    echo '非法操作!';
                    exit();
            }            
        }
        public function showFrontNav(){
            $this->tpl->assign('frontNav',$this->model->getFrontNav());
        }
        //显示投票主题列表
        private function show(){ 
            //print_r($this->model->nextid('cms_nav')); 
            if($this->model->getTotal()!=0){                             
                parent::page($this->model->getTotal(),5,1);
            }
            $object=$this->model->getAllVote();
            if($object){
                foreach ($object as $value){
                    if($value->state==1){
                        $value->state='<span style="color:green">[是]</span>';
                    }elseif($value->state==0){
                        $value->state='<span style="color:red">[否]</span>'.' | '.'<a href="?action=state&type=ok&id='.$value->id.'">通过</a>';
                    }
                    if(empty($value->pcount)){
                        $value->pcount=0;
                    }
                }
            }
            $this->tpl->assign('show',true);
            $this->tpl->assign('title','投票主题列表');
            $this->tpl->assign('vote',$object);;
            
        }
        //导航排序
        private function sort(){
            if(isset($_POST['send'])){
                $this->model->sort=$_POST['sort'];
                 if($this->model->setNavSort()) Tool::alertLocation(null, PREV_URL);
            }
        }
        //显示投票项目列表
        private function showchild(){
            if(isset($_GET['id'])){
                $this->model->id=$_GET['id'];
                if(is_object($this->model->getOneVote())){
                    $this->tpl->assign('prev_name',$this->model->getOneVote()->title);
                    $this->tpl->assign('prev_id',$this->model->getOneVote()->id);
                }else{
                    Tool::alertBack('主投票主题不存在');
                }
            }
            if($this->model->getChildTotal()!=0){
                parent::page($this->model->getChildTotal(),5,1);
            }
            $this->tpl->assign('showchild',true);
            $this->tpl->assign('title','查看投票项目');
            $this->tpl->assign('votechild', $this->model->getChildAllVote());
        }
        //新增投票主题
         private function add(){
            if(isset($_POST['send'])){
                if(Validate::checkNull($_POST['title'])) Tool::alertBack('投票主题不得为空');
                if(Validate::checkLength($_POST['title'], 2, min)) Tool::alertBack('投票主题不得小于2位');
                if(Validate::checkLength($_POST['title'], 20, max)) Tool::alertBack('投票主题不得大于20位');  
                if(Validate::checkLength($_POST['info'], 200, max)) Tool::alertBack('主题信息不得大于200位');
                $this->model->title=$_POST['title'];
                $this->model->info=$_POST['info'];  
                if($this->model->getOneVote()) Tool::alertBack('此投票主题已存在');
                $this->model->addVote()?Tool::alertLocation('新增投票主题成功', 'vote.inc.php?action=show') : Tool::alertBack('新增投票主题失败');
            }    
            $this->tpl->assign('add',true);
            $this->tpl->assign('title','新增投票主题');
        }
        //新增投票项目
        private function addchild(){
            if(isset($_GET['id'])){
                $this->model->id=$_GET['id'];
                $object=$this->model->getOneVote();
                if(is_object($object)){
                    $this->tpl->assign('prev_name',$object->title);
                    $this->tpl->assign('prev_id',$object->id);
                    $this->tpl->assign('prev_url',PREV_URL);
                }else{
                    Tool::alertBack('主投票主题不存在');
                }
            }
            if(isset($_POST['send']) && isset($_POST['id'])){
                 if(Validate::checkNull($_POST['title'])) Tool::alertBack('投票主题不得为空');
                if(Validate::checkLength($_POST['title'], 2, min)) Tool::alertBack('投票主题不得小于2位');
                if(Validate::checkLength($_POST['title'], 20, max)) Tool::alertBack('投票主题不得大于20位');  
                if(Validate::checkLength($_POST['info'], 200, max)) Tool::alertBack('主题信息不得大于200位');
                $this->model->title=$_POST['title'];
                $this->model->info=$_POST['info'];
                $this->model->vid=$_POST['id'];
                if($this->model->getOneVoteX()) Tool::alertBack('此主题中已存在此项目');
                $this->model->addChildVote()?Tool::alertLocation('新增投票项目成功', $_POST['prev_url']) : Tool::alertBack('新增投票项目失败');
            }
            $this->tpl->assign('addchild',true);
            $this->tpl->assign('title','新增投票项目');
        }
        //修改投票主题
        private function update(){
            if(isset($_GET['id'])){
                $this->model->id=$_GET['id'];
                $object=$this->model->getOneVote();
                if(is_object($object)){
                    $this->tpl->assign('titlev',$object->title);
                    $this->tpl->assign('info',$object->info);
                    $this->tpl->assign('update_id',$object->id);
                }else{
                    Tool::alertBack('投票主题不存在');
                }
            
            }
            if(isset($_POST['id']) && isset($_POST['send'])){
                if(Validate::checkNull($_POST['title'])) Tool::alertBack('投票主题不得为空');
                if(Validate::checkLength($_POST['title'], 2, min)) Tool::alertBack('投票主题不得小于2位');
                if(Validate::checkLength($_POST['title'], 20, max)) Tool::alertBack('投票主题不得大于20位');  
                if(Validate::checkLength($_POST['info'], 200, max)) Tool::alertBack('主题信息不得大于200位');
                $this->model->title=$_POST['title'];
                $this->model->info=$_POST['info'];
               // if($this->model->getOneManage()) Tool::alertBack('此用户名已存在');
                $this->model->id=$_POST['id'];
                $this->model->updateVote()?Tool::alertLocation('修改投票成功', $_POST['prev_url']) : Tool::alertBack('修改投票失败');            
            }
            $this->tpl->assign('update',true);
            $this->tpl->assign('title','修改投票');
            //$this->tpl->assign('alllevel',$this->model->getAllLevel());
        }
        //审核
        private function state(){
            //单条审核
            if(isset($_GET['id'])){
                $this->model->id=$_GET['id'];
                if($_GET['type']=='ok'){
                    $this->model->setStateCancel();
                    if($this->model->setStateOk()){
                        Tool::alertLocation(null, PREV_URL);
                    }else{
                        Tool::alertBack('审核通过失败');
                    }
                }else{
                    Tool::alertBack('非法操作');
                }
            }
        }
        //删除投票主题或项目
        private function delete(){
            if(isset($_GET['id'])){
                $this->model->id=$_GET['id'];
                $this->model->deleteVote()?Tool::alertLocation('删除成功', PREV_URL) : Tool::alertBack('删除失败');
            }
        } 
    }
?>