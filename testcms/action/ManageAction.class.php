<?php 
    //控制器类
    class ManageAction extends Action{
        public function __construct(&$tpl){
            parent::__construct($tpl, new ManageModel());           
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
        //显示管理员列表
        private function show(){                               
            parent::page($this->model->getTotal());
            $this->tpl->assign('show',true);
            $this->tpl->assign('title','管理员列表');
            $this->tpl->assign('manage', $this->model->getAllManage());
            $this->tpl->assign('total', $this->model->getTotal());
        }
        //新增管理员
        private function add(){
            if(isset($_POST['send'])){
                if(Validate::checkNull($_POST['username'])) Tool::alertBack('用户名不得为空');
                if(Validate::checkLength($_POST['username'], 2, min)) Tool::alertBack('用户名不得小于2位');
                if(Validate::checkLength($_POST['username'], 20, max)) Tool::alertBack('用户名不得大于20位');
                if(Validate::checkNull($_POST['password'])) Tool::alertBack('密码不得为空');
                if(Validate::checkLength($_POST['password'], 6, min)) Tool::alertBack('密码不得小于6位');
                if(Validate::checkEquals($_POST['password'], $_POST['notpassword'])) Tool::alertBack('密码和密码确认不一致');      
                $this->model->admin_user=$_POST['username'];
                if($this->model->getOneManage()) Tool::alertBack('此用户名已存在');
                $this->model->admin_pass=sha1($_POST['password']);
                $this->model->level=$_POST['level'];
                $this->model->addManage()?Tool::alertLocation('新增管理员成功', 'manage.inc.php?action=show') : Tool::alertBack('新增管理员失败');
            }
            $this->tpl->assign('add',true);
            $this->tpl->assign('title','新增管理员');
            $this->tpl->assign('alllevel',$this->model->getAllLevel());
        }
        //修改管理员
        private function update(){
            if(isset($_GET['id'])){
                $this->model->id=$_GET['id'];
                if(is_object($this->model->getOneManage())){
                    $this->tpl->assign('update_user',$this->model->getOneManage()->admin_user);
                    $this->tpl->assign('update_level',$this->model->getOneManage()->level);
                    $this->tpl->assign('update_id',$this->model->getOneManage()->id);
                }else{
                    Tool::alertBack('管理员不存在');
                }
            
            }
            if(isset($_POST['id']) && isset($_POST['send'])){
                if(Validate::checkNull($_POST['username'])) Tool::alertBack('用户名不得为空');
                if(Validate::checkLength($_POST['username'], 2, min)) Tool::alertBack('用户名不得小于2位');
                if(Validate::checkLength($_POST['username'], 20, max)) Tool::alertBack('用户名不得大于20位');
                $this->model->admin_user=$_POST['username'];
               // if($this->model->getOneManage()) Tool::alertBack('此用户名已存在');
                if(!empty($_POST['password'])){
                    if(Validate::checkLength($_POST['password'], 2, min)) Tool::alertBack('密码不得小于6位');
                    $this->model->admin_pass=sha1($_POST['password']);
                }else{
                    $this->model->admin_pass="";
                }
                $this->model->id=$_POST['id'];
                $this->model->level=$_POST['level'];
                $this->model->updateManage()?Tool::alertLocation('修改管理员成功', $_POST['prev_url']) : Tool::alertBack('修改管理员失败');            
            }
            $this->tpl->assign('update',true);
            $this->tpl->assign('title','修改管理员');
            $this->tpl->assign('alllevel',$this->model->getAllLevel());
        }
        //删除管理员
        private function delete(){
            if(isset($_GET['id'])){
                $this->model->id=$_GET['id'];
                $this->model->deleteManage()?Tool::alertLocation('删除管理员成功', PREV_URL) : Tool::alertBack('删除管理员失败');
            }
        }
       
    }
?>