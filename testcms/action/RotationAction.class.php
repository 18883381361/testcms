<?php 
    //控制器类
    class RotationAction extends Action{
        public function __construct(&$tpl){
            parent::__construct($tpl, new RotationModel());           
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
                case 'xml' :
                    $this->xml();
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
                parent::page($this->model->getTotal(),5,1);
            }
            $object= $this->model->getAllRotation();
            foreach ($object as $value){
                Tool::subStr($object, link, 20,'utf-8');
                if($value->state==1){
                    $value->state='<span style="color:green">[是]</span>'.' | '.'<a href="?action=state&type=cancel&id='.$value->id.'">取消</a>';
                }elseif($value->state==0){
                    $value->state='<span style="color:red">[否]</span>'.' | '.'<a href="?action=state&type=ok&id='.$value->id.'">通过</a>';
                }
            }
            $this->tpl->assign('show',true);
            $this->tpl->assign('title','轮播器列表');
            $this->tpl->assign('AllRotation',$object);
            //$this->tpl->assign('total', $this->model->getTotal());
            
        }
        //新增轮播图
         private function add(){
            if(isset($_POST['send'])){
                if(Validate::checkNull($_POST['thumb'])) Tool::alertBack('轮播图不得为空');
                if(Validate::checkNull($_POST['link'])) Tool::alertBack('链接不得为空');
                if(Validate::checkLength($_POST['title'], 20, max)) Tool::alertBack('标题不得大于20位');  
                if(Validate::checkLength($_POST['info'], 200, max)) Tool::alertBack('描述信息不得大于200位');
                $this->model->thumb=$_POST['thumb'];
                $this->model->link=$_POST['link'];
                $this->model->title=$_POST['title'];  
                $this->model->info=$_POST['info'];
                //if($this->model->getOneNav()) Tool::alertBack('此导航名称已存在');
                $this->model->addRotation()?Tool::alertLocation('新增轮播图成功', 'rotation.inc.php?action=show') : Tool::alertBack('新增轮播图失败');
            }    
            $this->tpl->assign('add',true);
            $this->tpl->assign('title','新增轮播器');
        }
        //修改轮播图
        private function update(){
            if(isset($_GET['id'])){
                $this->model->id=$_GET['id'];
                $object=$this->model->getOneRotation();
                if(is_object($object)){
                    $this->tpl->assign('thumb',$object->thumb);
                    $this->tpl->assign('link',$object->link);
                    $this->tpl->assign('titler',$object->title);
                    $this->tpl->assign('info',$object->info);
                    $this->tpl->assign('update_id',$object->id);
                }else{
                    Tool::alertBack('轮播图不存在');
                }
            
            }
            if(isset($_POST['id']) && isset($_POST['send'])){
                if(Validate::checkNull($_POST['thumb'])) Tool::alertBack('轮播图不得为空');
                if(Validate::checkNull($_POST['link'])) Tool::alertBack('链接不得为空');
                if(Validate::checkLength($_POST['title'], 20, max)) Tool::alertBack('标题不得大于20位');  
                if(Validate::checkLength($_POST['info'], 200, max)) Tool::alertBack('描述信息不得大于200位');
                $this->model->thumb=$_POST['thumb'];
                $this->model->link=$_POST['link'];
                $this->model->title=$_POST['title'];  
                $this->model->info=$_POST['info'];
                $this->model->id=$_POST['id'];
                $this->model->updateRotation()?Tool::alertLocation('修改轮播图成功', $_POST['prev_url']) : Tool::alertBack('修改轮播图失败');            
            }
            $this->tpl->assign('update',true);
            $this->tpl->assign('title','修改轮播器');
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
        //生成xml文件
        private function xml(){
            $object=$this->model->getNewRotation();
            $xml.='<?xml version="1.0" encoding="utf-8"?>'."\r\n";
            $xml.='<bcaster autoPlayTime="'.RO_NUM.'"> '."\r\n";
            if($object){
                foreach ($object as $value){
                    $xml.='<item item_url="'.$value->thumb.'"  link="'.$value->link.'"  itemtitle=""></item> '."\r\n";
                }
            }
            $xml.='</bcaster>'."\r\n";
            $exc=new SimpleXMLElement($xml);
            $exc->asXML('../bcastr.xml');
            Tool::alertLocation('xml生成成功','?action=show');
        }
        //删除轮播图
        private function delete(){
            if(isset($_GET['id'])){
                $this->model->id=$_GET['id'];
                $this->model->deleteRotation()?Tool::alertLocation('删除轮播图成功', PREV_URL) : Tool::alertBack('删除轮播图失败');
            }
        } 
    }
?>