<?php 
class LoginAction extends Action{
    public function __construct(&$tpl){
        parent::__construct($tpl, new ManageModel());
    }
    
    public function action(){
        switch ($_GET['action']){
            case 'login'  :
                $this->login();
                break;
            case 'logout'  :
                $this->logout();
                break;
        }
    }
    
    //登录
    private function login(){
        if(isset($_POST['admin_login'])){
            if(Validate::checkLength($_POST['code'], 4, equal)) Tool::alertBack('验证码长度必须是4位');
            if(Validate::checkSessionCode($_POST['code'])) Tool::alertBack('验证码有误');
            if(Validate::checkNull($_POST['admin_name'])) Tool::alertBack('用户名不得为空');
            if(Validate::checkLength($_POST['admin_name'], 2, min)) Tool::alertBack('用户名不得小于2位');
            if(Validate::checkLength($_POST['admin_name'], 20, max)) Tool::alertBack('用户名不得大于20位');
            if(Validate::checkNull($_POST['admin_pass'])) Tool::alertBack('密码不得为空');
            if(Validate::checkLength($_POST['admin_pass'], 6, min)) Tool::alertBack('密码不得小于6位');
            $this->model->admin_user=$_POST['admin_name'];
            if(!$this->model->getOneManage()) Tool::alertBack('此用户不存在');
            if($this->model->getOneManage()->admin_pass!=sha1($_POST['admin_pass'])) Tool::alertBack('密码不正确');
            
            $levelmode=new LevelModel();
            $levelmode->level=$this->model->getOneManage()->level;
            $levelname= $levelmode->getOneLevel()->level_name;
            $premission=$levelmode->getOneLevel()->premission;
            $preArray=explode(',', $premission);
            if(in_array('1',$preArray )){
                $this->model->last_ip=$_SERVER['REMOTE_ADDR'];
                $_SESSION['admin']['admin_name']=$this->model->getOneManage()->admin_user;
                $_SESSION['admin']['level_name']=$levelname;
                $_SESSION['admin']['premission']=$preArray;
                $this->model->setCount();
                Tool::alertLocation('登录成功', 'admin.php');
            }else{
                Tool::alertBack('您没有登录的权限');
            }
        }
    }
    
    private function logout(){
        Tool::alertLocation(null, 'admin_login.php');
        Tool::cleanSession();        
    }
}
?>