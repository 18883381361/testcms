<?php 
    //控制器类
    class FriendLinkAction extends Action{
        public function __construct(&$tpl){
            parent::__construct($tpl,new LinkModel());
        }
       public function action(){
           switch ($_GET['action']){
               case 'frontadd'  :   $this->frontadd();
                                    break;
               case  'frontshow'     :
                                    $this->frontshow();
                                    break;
              default:
                        Tool::alertBack('警告：非法操作！');
           }
       }
       //前台申请加入
       private function frontadd(){  
           if (isset($_POST['send'])) {
               if (Validate::checkNull($_POST['webname'])) Tool::alertBack('警告：网站名称不得为空！');
				if (Validate::checkLength($_POST['webname'],20,'max')) Tool::alertBack('警告：网站名称不得大于二十位！');
				if (Validate::checkNull($_POST['weburl'])) Tool::alertBack('警告：网站地址不得为空！');
				if (Validate::checkLength($_POST['webname'],100,'max')) Tool::alertBack('警告：网站地址不得大于一百位！');
				if ($_POST['type'] == 2) {
					if (Validate::checkNull($_POST['logourl'])) Tool::alertBack('警告：Logo地址不得为空！');
					if (Validate::checkLength($_POST['logourl'],100,'max')) Tool::alertBack('警告：Logo地址不得大于一百位！');
				}
				if (Validate::checkLength($_POST['user'],20,'max')) Tool::alertBack('警告：站长名不得大于二十位！');
				if (Validate::checkLength($_POST['code'],4,'equal')) Tool::alertBack('警告：验证码必须是四位！');
				if(Validate::checkSessionCode($_POST['code'])) Tool::alertBack('验证码有误');
				
				
				$this->model->webname = $_POST['webname'];
				$this->model->weburl = $_POST['weburl'];
				$this->model->logourl = $_POST['logourl'];
				$this->model->user = $_POST['user'];
				$this->model->type = $_POST['type'];
				$this->model->state = $_POST['state'];
				$this->model->addLink() ? Tool::alertClose('恭喜，申请友情链接成功！请等待管理员审核！') : Tool::alertBack('很遗憾，申请友情链接失败，请重试！');
           }        
           $this->tpl->assign('frontadd',true);
       }
       //显示所有链接
       private function frontshow(){
           $text=$this->model->getAllTextLink();
           if($text) $this->tpl->assign('allText',$text);
           $logo=$this->model->getAllLogoLink();
           if($logo) $this->tpl->assign('allLogo',$logo);
           $this->tpl->assign('frontshow',true);
       }
       //显示友情链接
       public function index(){
           $link=new LinkModel();
           //文字链接
           if($link->getTwentyTextLink()){
               $this->tpl->assign('text_link',$link->getTwentyTextLink());
           }
           //logo链接
           if($link->getNineLogoLink()){
               $this->tpl->assign('logo_link',$link->getNineLogoLink());
           }
       }
    }
?>