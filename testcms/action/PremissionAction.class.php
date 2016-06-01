<?php 
    //控制器类
    class PremissionAction extends Action{
        public function __construct(&$tpl){
            parent::__construct($tpl, new PremissionModel());           
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
                default:
                    echo '非法操作!';
                    exit();
            }            
        }
        public function showFrontNav(){
            $this->tpl->assign('frontNav',$this->model->getFrontNav());
        }
        //显示权限列表
        private function show(){ 
            //print_r($this->model->nextid('cms_nav')); 
            if($this->model->getTotal()!=0){                             
                parent::page($this->model->getTotal());
            }
            $this->tpl->assign('show',true);
            $this->tpl->assign('title','权限列表');
            $this->tpl->assign('premission', $this->model->getAllPremission());
            
        }

        //新增权限
         private function add(){
            if(isset($_POST['send'])){
                if(Validate::checkNull($_POST['name'])) Tool::alertBack('权限名称不得为空');
                if(Validate::checkLength($_POST['name'], 2, min)) Tool::alertBack('权限名称不得小于2位');
                if(Validate::checkLength($_POST['name'], 100, max)) Tool::alertBack('权限名称不得大于100位');  
                if(Validate::checkLength($_POST['info'], 200, max)) Tool::alertBack('权限信息不得大于200位');
                $this->model->name=$_POST['name'];
                $this->model->info=$_POST['info'];  
                if($this->model->getOnePremission()) Tool::alertBack('此权限名称已存在');
                $this->model->addPremission()?Tool::alertLocation('新增权限成功', 'premission.inc.php?action=show') : Tool::alertBack('新增权限失败');
            }    
            $this->tpl->assign('add',true);
            $this->tpl->assign('title','新增权限');
        }
       
        //修改权限
        private function update(){
            if(isset($_GET['id'])){
                $this->model->id=$_GET['id'];
                if(is_object($this->model->getOnePremission())){
                    $this->tpl->assign('name',$this->model->getOnePremission()->name);
                    $this->tpl->assign('info',$this->model->getOnePremission()->info);
                    $this->tpl->assign('update_id',$this->model->getOnePremission()->id);
                }else{
                    Tool::alertBack('权限不存在');
                }
            
            }
            if(isset($_POST['id']) && isset($_POST['send'])){
                                if(Validate::checkNull($_POST['name'])) Tool::alertBack('权限名称不得为空');
                if(Validate::checkLength($_POST['name'], 2, min)) Tool::alertBack('权限名称不得小于2位');
                if(Validate::checkLength($_POST['name'], 100, max)) Tool::alertBack('权限名称不得大于100位');  
                if(Validate::checkLength($_POST['info'], 200, max)) Tool::alertBack('权限信息不得大于200位');
                $this->model->name=$_POST['name'];
                $this->model->info=$_POST['info'];
               // if($this->model->getOneManage()) Tool::alertBack('此用户名已存在');
                $this->model->id=$_POST['id'];
                $this->model->updatePremission()?Tool::alertLocation('修改权限成功', $_POST['prev_url']) : Tool::alertBack('修改权限失败');            
            }
            $this->tpl->assign('update',true);
            $this->tpl->assign('title','修改权限');
            //$this->tpl->assign('alllevel',$this->model->getAllLevel());
        }
        //删除导航
        private function delete(){
            if(isset($_GET['id'])){
                $this->model->id=$_GET['id'];
                $this->model->deletePremission()?Tool::alertLocation('删除权限成功', PREV_URL) : Tool::alertBack('删除权限失败');
            }
        } 
    }
?>