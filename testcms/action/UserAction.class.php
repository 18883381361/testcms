<?php 
    //控制器类
    class UserAction extends Action{
        public function __construct(&$tpl){
            parent::__construct($tpl, new UserModel());           
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
                case 'sort' :
                    $this->sort();
                    break;
                default:
                    echo '非法操作!';
                    exit();
            }            
        }
        //显示会员列表
        private function show(){ 
            if($this->model->getTotal()!=0){
                parent::page($this->model->getTotal(),2,1);
            }
            $object=$this->model->getAllUser();
            foreach ($object as $_value){
                switch ($_value->state){
                    case 0 :
						$_value->state = '被封杀的会员';
						break;
					case 1 :
						$_value->state = '待审核的会员';
						break;
					case 2 :
						$_value->state = '初级会员';
						break;
					case 3 :
						$_value->state = '中级会员';
						break;
					case 4 :
						$_value->state = '高级会员';
						break;
					case 5 :
						$_value->state = 'VIP会员';
						break;
                }
            }
            
            $this->tpl->assign('user',$object);
            $this->tpl->assign('show',true);
            $this->tpl->assign('title','会员列表');

            
        }
        //新增会员
         private function add(){
            if(isset($_POST['send'])){
                if (Validate::checkNull($_POST['username'])) Tool::alertBack('警告：用户名不得为空！');
                if (Validate::checkLength($_POST['username'],2,'min')) Tool::alertBack('警告：用户名长度不得小于两位！');
                if (Validate::checkLength($_POST['username'],20,'max')) Tool::alertBack('警告：用户名长度不得大于二十位！');
                if (Validate::checkLength($_POST['password'],6,'min')) Tool::alertBack('警告：密码不得小于六位！');
                if (Validate::checkEquals($_POST['password'],$_POST['notpassword'])) Tool::alertBack('警告：密码和确认密码不一致！');
                if (Validate::checkNull($_POST['email'])) Tool::alertBack('警告：电子邮件不得为空！');
                if (Validate::checkEmail($_POST['email'])) Tool::alertBack('警告：电子邮件格式不正确！');
                if (!Validate::checkNull($_POST['question']) && !Validate::checkNull($_POST['answer'])) {
                    $this->model->question = $_POST['question'];
                    $this->model->answer = $_POST['answer'];
                }
                $this->model->username = $_POST['username'];
                $this->model->password = sha1($_POST['password']);
                $this->model->email = $_POST['email'];
                $this->model->face = $_POST['face'];
                $this->model->state = $_POST['state'];
                $this->model->time=null;
                if($this->model->getOneUser()) Tool::alertBack('此会员已存在');
                if($this->model->getOneEmail()) Tool::alertBack('此邮箱已被注册过');
                $this->model->addUser() ? Tool::alertLocation('恭喜你，新增成功！','./') : Tool::alertBack('很遗憾，新增失败！');
            }    
            $this->tpl->assign('add',true);
            $this->tpl->assign('title','新增会员');
            $this->tpl->assign('faceOne',range(1, 9));
            $this->tpl->assign('faceTwo',range(10, 24));
        }
        
        //修改会员
        private function update(){
            if(isset($_GET['id'])){
                $this->model->id=$_GET['id'];
                if(is_object($user=$this->model->getOneUser())){
                    $this->tpl->assign('username',$user->username);
                    $this->tpl->assign('email',$user->email);
                    $this->tpl->assign('faceimg',$user->face);
                    $this->tpl->assign('answer',$user->answer);
                    $this->tpl->assign('id',$user->id);
                    $this->state($user->state);
                    $this->question($user->question);
                    $this->face($user->face);
                }else{
                    Tool::alertBack('会员不存在');
                }
            
            }
            if(isset($_POST['id']) && isset($_POST['send'])){
                if (Validate::checkNull($_POST['username'])) Tool::alertBack('警告：用户名不得为空！');
                if (Validate::checkLength($_POST['username'],2,'min')) Tool::alertBack('警告：用户名长度不得小于两位！');
                if (Validate::checkLength($_POST['username'],20,'max')) Tool::alertBack('警告：用户名长度不得大于二十位！');
                if(!empty($_POST['password'])){
                    if (Validate::checkLength($_POST['password'],6,'min')) Tool::alertBack('警告：密码不得小于六位！');
                }
                if (Validate::checkNull($_POST['email'])) Tool::alertBack('警告：电子邮件不得为空！');
                if (Validate::checkEmail($_POST['email'])) Tool::alertBack('警告：电子邮件格式不正确！');
                if (!Validate::checkNull($_POST['question']) && !Validate::checkNull($_POST['answer'])) {
                    $this->model->question = $_POST['question'];
                    $this->model->answer = $_POST['answer'];
                }
                $this->model->username = $_POST['username'];
                if(!empty($_POST['password'])){
                     $this->model->password = sha1($_POST['password']);
                }else{
                    $this->model->password = null;
                }
                $this->model->email = $_POST['email'];
                $this->model->face = $_POST['face'];
                $this->model->state = $_POST['state'];
                $this->model->time=null;
                $this->model->id=$_POST['id'];
                if($this->model->updateUser()) Tool::alertLocation('修改会员成功', $_POST['prev_url']);
            }
            $this->tpl->assign('update',true);
            $this->tpl->assign('title','修改会员');
            //$this->tpl->assign('alllevel',$this->model->getAllLevel());
        }
        //删除会员
        private function delete(){
            if(isset($_GET['id'])){
                $this->model->id=$_GET['id'];
                $this->model->deleteUser()?Tool::alertLocation('删除会员成功', PREV_URL) : Tool::alertBack('删除会员失败');
            }
        } 
        //question
        private function question($question){
            $qArray=array('您父亲的姓名？','您母亲的职业？','您配偶的性别？');
            foreach ($qArray as $value){
                if($value==$question){
                    $html.='<option value="'.$value.'" selected="selected">'.$value.'</option>';
                }else{
                    $html.='<option value="'.$value.'">'.$value.'</option>';
                }
            }
            $this->tpl->assign('question',$html);
        }
        //state
        private function state($state){
            $sArray=array('被封杀的会员','待审核的会员','初级会员','中级会员','高级会员','VIP会员');
            foreach ($sArray as $key=>$value){
                if($key==$state){
                    $html.='<input type="radio" name="state" value="'.$key.'" checked="checked" /> '.$value.'';
                }else{
                    $html.='<input type="radio" name="state" value="'.$key.'" /> '.$value.'';
                }
            }
            $this->tpl->assign('state',$html);
        }
        //face
        private function face($face){
            foreach (range(1, 9) as $value){
                if($face=='0'.$value.'.gif'){
                   $html.= '<option value="0'.$value.'.gif" selected="selected">0'.$value.'.gif</option>';
                }else{
                    $html.= '<option value="0'.$value.'.gif">0'.$value.'.gif</option>';
                }
            }
            foreach (range(10, 24) as $value){
                if($face==$value.'.gif'){
                    $html.= '<option value="'.$value.'.gif" selected="selected">'.$value.'.gif</option>';
                }else{
                    $html.= '<option value="'.$value.'.gif">'.$value.'.gif</option>';
                }
            }
            $this->tpl->assign('face',$html);
        }
    }
?>