<?php 
    //控制器类
    class NavAction extends Action{
        public function __construct(&$tpl){
            parent::__construct($tpl, new NavModel());           
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
                case 'showchild' :
                    $this->showchild();
                    break;
                case 'sort' :
                    $this->sort();
                    break;
                default:
                    echo '非法操作!';
                    exit();
            }            
        }
        public function showFrontNav(){
            $this->tpl->assign('frontNav',$this->model->getFrontNav());
        }
        //显示导航列表
        private function show(){ 
            //print_r($this->model->nextid('cms_nav')); 
            if($this->model->getTotal()!=0){                             
                parent::page($this->model->getTotal(),5,1);
            }
            $this->tpl->assign('show',true);
            $this->tpl->assign('title','导航列表');
            $this->tpl->assign('nav', $this->model->getAllNav());
            $this->tpl->assign('total', $this->model->getTotal());
            
        }
        //导航排序
        private function sort(){
            if(isset($_POST['send'])){
                $this->model->sort=$_POST['sort'];
                 if($this->model->setNavSort()) Tool::alertLocation(null, PREV_URL);
            }
        }
        //显示子导航列表
        private function showchild(){
            if(isset($_GET['id'])){
                $this->model->id=$_GET['id'];
                if(is_object($this->model->getOneNav())){
                    $this->tpl->assign('prev_name',$this->model->getOneNav()->nav_name);
                    $this->tpl->assign('prev_id',$this->model->getOneNav()->id);
                }else{
                    Tool::alertBack('主导航不存在');
                }
            }
            if($this->model->getChildTotal()!=0){
                parent::page($this->model->getChildTotal(),1,showchild,$_GET['id']);
            }
            $this->tpl->assign('showchild',true);
            $this->tpl->assign('title','查看子导航');
            $this->tpl->assign('navchild', $this->model->getChildAllNav());
            $this->tpl->assign('total', $this->model->getChildTotal());
        }
        //新增导航
         private function add(){
            if(isset($_POST['send'])){
                if(Validate::checkNull($_POST['nav_name'])) Tool::alertBack('导航名称不得为空');
                if(Validate::checkLength($_POST['nav_name'], 2, min)) Tool::alertBack('导航名称不得小于2位');
                if(Validate::checkLength($_POST['nav_name'], 20, max)) Tool::alertBack('导航名称不得大于20位');  
                if(Validate::checkLength($_POST['nav_info'], 200, max)) Tool::alertBack('导航信息不得大于200位');
                $this->model->nav_name=$_POST['nav_name'];
                $this->model->nav_info=$_POST['nav_info'];  
                if($this->model->getOneNav()) Tool::alertBack('此导航名称已存在');
                $this->model->addNav()?Tool::alertLocation('新增导航成功', 'nav.inc.php?action=show') : Tool::alertBack('新增导航失败');
            }    
            $this->tpl->assign('add',true);
            $this->tpl->assign('title','新增导航');
        }
        //新增子导航
        private function addchild(){
            if(isset($_GET['id'])){
                $this->model->id=$_GET['id'];
                if(is_object($this->model->getOneNav())){
                    $this->tpl->assign('prev_name',$this->model->getOneNav()->nav_name);
                    $this->tpl->assign('prev_id',$this->model->getOneNav()->id);
                    $this->tpl->assign('prev_url',PREV_URL);
                }else{
                    Tool::alertBack('主导航不存在');
                }
            }
            if(isset($_POST['send']) && isset($_POST['id'])){
                if(Validate::checkNull($_POST['nav_name'])) Tool::alertBack('导航名称不得为空');
                if(Validate::checkLength($_POST['nav_name'], 2, min)) Tool::alertBack('导航名称不得小于2位');
                if(Validate::checkLength($_POST['nav_name'], 20, max)) Tool::alertBack('导航名称不得大于20位');
                if(Validate::checkLength($_POST['nav_info'], 200, max)) Tool::alertBack('导航信息不得大于200位');
                $this->model->nav_name=$_POST['nav_name'];
                $this->model->nav_info=$_POST['nav_info'];
                $this->model->pid=$_POST['id'];
                $this->model->id=null;
                if($this->model->getOneNav()) Tool::alertBack('此导航名称已存在');
                $this->model->addChildNav()?Tool::alertLocation('新增导航成功', $_POST['prev_url']) : Tool::alertBack('新增导航失败');
            }
            $this->tpl->assign('addchild',true);
            $this->tpl->assign('title','新增子导航');
        }
        //修改导航
        private function update(){
            if(isset($_GET['id'])){
                $this->model->id=$_GET['id'];
                if(is_object($this->model->getOneNav())){
                    $this->tpl->assign('nav_name',$this->model->getOneNav()->nav_name);
                    $this->tpl->assign('nav_info',$this->model->getOneNav()->nav_info);
                    $this->tpl->assign('update_id',$this->model->getOneNav()->id);
                }else{
                    Tool::alertBack('导航不存在');
                }
            
            }
            if(isset($_POST['id']) && isset($_POST['send'])){
                if(Validate::checkNull($_POST['nav_name'])) Tool::alertBack('导航名称不得为空');
                if(Validate::checkLength($_POST['nav_name'], 2, min)) Tool::alertBack('导航名称不得小于2位');
                if(Validate::checkLength($_POST['nav_name'], 20, max)) Tool::alertBack('导航名称不得大于20位');
                $this->model->nav_name=$_POST['nav_name'];
                $this->model->nav_info=$_POST['nav_info'];
               // if($this->model->getOneManage()) Tool::alertBack('此用户名已存在');
                $this->model->id=$_POST['id'];
                $this->model->updateNav()?Tool::alertLocation('修改导航成功', $_POST['prev_url']) : Tool::alertBack('修改导航失败');            
            }
            $this->tpl->assign('update',true);
            $this->tpl->assign('title','修改导航');
            //$this->tpl->assign('alllevel',$this->model->getAllLevel());
        }
        //删除导航
        private function delete(){
            if(isset($_GET['id'])){
                $this->model->id=$_GET['id'];
                $this->model->deleteNav()?Tool::alertLocation('删除导航成功', PREV_URL) : Tool::alertBack('删除导航失败');
            }
        } 
    }
?>