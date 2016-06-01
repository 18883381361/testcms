<?php 
    //控制器类
    class RegisterAction extends Action{
        public function __construct(&$tpl){
            parent::__construct($tpl);
        }
       public function action(){
           switch ($_GET['action']){
               case 'reg':  $this->reg();
                            break;
               case  'login':
                             $this->login();
                             break;
               case 'logout':$this->logout();
                             break;
              default:
                        Tool::alertBack('警告：非法操作！');
                        exit();
           }
       }
       //注册页面
       private function reg(){  
           if (isset($_POST['send'])) {
               parent::__construct($this->_tpl, new UserModel());
               if (Validate::checkNull($_POST['username'])) Tool::alertBack('警告：用户名不得为空！');
               if (Validate::checkLength($_POST['username'],2,'min')) Tool::alertBack('警告：用户名长度不得小于两位！');
               if (Validate::checkLength($_POST['username'],20,'max')) Tool::alertBack('警告：用户名长度不得大于二十位！');
               if (Validate::checkLength($_POST['password'],6,'min')) Tool::alertBack('警告：密码不得小于六位！');
               if (Validate::checkEquals($_POST['password'],$_POST['notpassword'])) Tool::alertBack('警告：密码和确认密码不一致！');
               if (Validate::checkNull($_POST['email'])) Tool::alertBack('警告：电子邮件不得为空！');
               if (Validate::checkEmail($_POST['email'])) Tool::alertBack('警告：电子邮件格式不正确！');
               if(Validate::checkLength($_POST['code'], 4, equal)) Tool::alertBack('验证码长度必须是4位');
               if(Validate::checkSessionCode($_POST['code'])) Tool::alertBack('验证码有误');
               if (!Validate::checkNull($_POST['question']) && !Validate::checkNull($_POST['answer'])) {
                   $this->model->question = $_POST['question'];
                   $this->model->answer = $_POST['answer'];
               }
               $this->model->username = $_POST['username'];
               $this->model->password = sha1($_POST['password']);
               $this->model->email = $_POST['email'];
               $this->model->face = $_POST['face'];
               $this->model->time=time();
               if($this->model->getOneUser()) Tool::alertBack('此会员已存在');
               if($this->model->getOneEmail()) Tool::alertBack('此邮箱已被注册过');
               $this->model->addUser() ? Tool::alertLocation('恭喜你，注册成功！','./') : Tool::alertBack('很遗憾，注册失败！');
           }        
           $this->tpl->assign('reg',true);
           $this->tpl->assign('faceOne',range(1, 9));
           $this->tpl->assign('faceTwo',range(10, 24));
       }
       //登录
       private function login(){
           if (isset($_POST['send'])) {
               parent::__construct($this->_tpl, new UserModel());
               if (Validate::checkNull($_POST['username'])) Tool::alertBack('警告：用户名不得为空！');
               if (Validate::checkLength($_POST['username'],2,'min')) Tool::alertBack('警告：用户名长度不得小于两位！');
               if (Validate::checkLength($_POST['username'],20,'max')) Tool::alertBack('警告：用户名长度不得大于二十位！');
               if (Validate::checkLength($_POST['password'],6,'min')) Tool::alertBack('警告：密码不得小于六位！');
               if(Validate::checkLength($_POST['code'], 4, equal)) Tool::alertBack('验证码长度必须是4位');
               if(Validate::checkSessionCode($_POST['code'])) Tool::alertBack('验证码有误');
               $this->model->username = $_POST['username'];
               if(!$this->model->getOneUser()) Tool::alertBack('此会员不存在');
               if($this->model->getOneUser()->password!=sha1($_POST['password'])) Tool::alertBack('密码不正确');
               if(!empty($_POST['time'])){
                    setcookie('user',$this->model->username,time()+$_POST['time']);
               }else{
                   setcookie('user',$this->model->username);
               }
               $this->model->time=time();
               $this->model->setLastLoginTime();
               Tool::alertLocation(null, 'index.php');
           }
           $this->tpl->assign('login',true);
       }
       //退出
       private function logout(){
           setcookie('user','',time()-1);
           Tool::alertLocation(null, '?action=login');
       }
    }
?>