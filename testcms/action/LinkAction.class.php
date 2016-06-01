<?php 
    //控制器类
    class LinkAction extends Action{
        public function __construct(&$tpl){
            parent::__construct($tpl, new LinkModel());           
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
                case 'state' :
                    $this->state();
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
        //显示轮播图列表
        private function show(){ 
            if($this->model->getTotal()!=0){                             
                parent::page($this->model->getTotal());
            }
            $object= $this->model->getAllLink();
            foreach ($object as $value){
                Tool::subStr($object, weburl, 20,'utf-8');
                Tool::subStr($object, logourl, 20,'utf-8');
                if($value->state==1){
                    $value->state='<span style="color:green">[是]</span>'.' | '.'<a href="?action=state&type=cancel&id='.$value->id.'">取消</a>';
                }elseif($value->state==0){
                    $value->state='<span style="color:red">[否]</span>'.' | '.'<a href="?action=state&type=ok&id='.$value->id.'">通过</a>';
                }
                switch ($value->type) {
                    case 1 :
                        $value->type = '文字链接';
                        break;
                    case 2 :
                        $value->type = 'Logo链接';
                        break;
                }
            }
            $this->tpl->assign('show',true);
            $this->tpl->assign('title','友情链接列表');
            $this->tpl->assign('AllLink',$object);
            //$this->tpl->assign('total', $this->model->getTotal());
            
        }
        //新增友情链接
         private function add(){
            if(isset($_POST['send'])){
               if (Validate::checkNull($_POST['webname'])) Tool::alertBack('警告：网站名称不得为空！');
				if (Validate::checkLength($_POST['webname'],20,'max')) Tool::alertBack('警告：网站名称不得大于二十位！');
				if (Validate::checkNull($_POST['weburl'])) Tool::alertBack('警告：网站地址不得为空！');
				if (Validate::checkLength($_POST['webname'],100,'max')) Tool::alertBack('警告：网站地址不得大于一百位！');
				if ($_POST['type'] == 2) {
					if (Validate::checkNull($_POST['logourl'])) Tool::alertBack('警告：Logo地址不得为空！');
					if (Validate::checkLength($_POST['logourl'],100,'max')) Tool::alertBack('警告：Logo地址不得大于一百位！');
				}
				if (Validate::checkLength($_POST['user'],20,'max')) Tool::alertBack('警告：站长名不得大于二十位！');
				$this->model->webname = $_POST['webname'];
				$this->model->weburl = $_POST['weburl'];
				$this->model->logourl = $_POST['logourl'];
				$this->model->user = $_POST['user'];
				$this->model->type = $_POST['type'];
				$this->model->state = $_POST['state'];
				$this->model->addLink() ? Tool::alertLocation('新增友情链接成功', '?action=show') : Tool::alertBack('很遗憾，申请友情链接失败，请重试！');
            }    
            $this->tpl->assign('add',true);
            $this->tpl->assign('title','新增友情链接');
        }
        //修改友情链接
        private function update(){
            if(isset($_GET['id'])){
                $this->model->id=$_GET['id'];
                $object=$this->model->getOneLink();
                if(is_object($object)){
                    if($object->type==1){
                        $checked='checked="checked"';
                        $logo='style="display:none;"';
                        $this->tpl->assign('text_type',$checked);
                        $this->tpl->assign('logo',$logo);
                    }else{
                        $checked='checked="checked"';
                        $logo='style="display:black;"';
                        $this->tpl->assign('logo_type',$checked);
                        $this->tpl->assign('logo',$logo);
                    }
                    
                    $this->tpl->assign('webname',$object->webname);
                    $this->tpl->assign('weburl',$object->weburl);
                    $this->tpl->assign('user',$object->user);
                    $this->tpl->assign('type',$object->type);
                    $this->tpl->assign('logourl',$object->logourl);
                    $this->tpl->assign('update_id',$object->id);
                }else{
                    Tool::alertBack('友情链接不存在');
                }
            
            }
            if(isset($_POST['id']) && isset($_POST['send'])){
               if (Validate::checkNull($_POST['webname'])) Tool::alertBack('警告：网站名称不得为空！');
				if (Validate::checkLength($_POST['webname'],20,'max')) Tool::alertBack('警告：网站名称不得大于二十位！');
				if (Validate::checkNull($_POST['weburl'])) Tool::alertBack('警告：网站地址不得为空！');
				if (Validate::checkLength($_POST['webname'],100,'max')) Tool::alertBack('警告：网站地址不得大于一百位！');
				if ($_POST['type'] == 2) {
					if (Validate::checkNull($_POST['logourl'])) Tool::alertBack('警告：Logo地址不得为空！');
					if (Validate::checkLength($_POST['logourl'],100,'max')) Tool::alertBack('警告：Logo地址不得大于一百位！');
				}
				if (Validate::checkLength($_POST['user'],20,'max')) Tool::alertBack('警告：站长名不得大于二十位！');
				$this->model->id = $_POST['id'];
				$this->model->webname = $_POST['webname'];
				$this->model->weburl = $_POST['weburl'];
				$this->model->logourl = $_POST['logourl'];
				$this->model->user = $_POST['user'];
				$this->model->type = $_POST['type'];
				$this->model->updateLink() ? Tool::alertLocation('修改友情链接成功', $_POST['prev_url']) : Tool::alertBack('很遗憾，修改友情链接失败，请重试！');
            }
            $this->tpl->assign('update',true);
            $this->tpl->assign('title','修改友情链接');
            //$this->tpl->assign('alllevel',$this->model->getAllLevel());
        }
        //审核
        private function state(){
            //单条审核
            if(isset($_GET['id'])){
                $this->model->id=$_GET['id'];
                if($_GET['type']=='ok'){
                    if($this->model->setStateOk()){
                        Tool::alertLocation(null, PREV_URL);
                    }else{
                        Tool::alertBack('审核通过失败');
                    }
                }elseif($_GET['type']=='cancel'){
                    if($this->model->setStateCancel()){
                        Tool::alertLocation(null, PREV_URL);
                    }else{
                        Tool::alertBack('审核取消失败');
                    }
                }else{
                    Tool::alertBack('非法操作');
                }
            }
        }
        //删除友情链接
        private function delete(){
            if(isset($_GET['id'])){
                $this->model->id=$_GET['id'];
                $this->model->deleteLink()?Tool::alertLocation('删除友情链接成功', PREV_URL) : Tool::alertBack('删除友情链接失败');
            }
        } 
    }
?>