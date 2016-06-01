<?php 
    //控制器类
    class AdverAction extends Action{
        public function __construct(&$tpl){
            parent::__construct($tpl, new AdverModel());           
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
                case 'js' :
                    $this->js();
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
        //显示广告列表
        private function show(){ 
            if(empty($_GET['type'])){
                $this->model->type='1,2,3';
            }else{
                $this->model->type=$_GET['type'];
            }
            if($this->model->getTotal()!=0){                             
                parent::page($this->model->getTotal());
            }
            $object= $this->model->getAllAdver();
            foreach ($object as $value){
                Tool::subStr($object, link, 20,'utf-8');
                if($value->state==1){
                    $value->state='<span style="color:green">[是]</span>'.' | '.'<a href="?action=state&type=cancel&id='.$value->id.'">取消</a>';
                }elseif($value->state==0){
                    $value->state='<span style="color:red">[否]</span>'.' | '.'<a href="?action=state&type=ok&id='.$value->id.'">通过</a>';
                }
                switch ($value->type){
                    case '1' :  $value->type='文字广告';
                                break;
                    case '2' :  $value->type='头部广告690x80';
                                break;
                    case '3' :  $value->type='侧栏广告270x200';
                                break;
                }
            }
            $this->tpl->assign('show',true);
            $this->tpl->assign('title','广告列表');
            $this->tpl->assign('AllAdver',$object);
            //$this->tpl->assign('total', $this->model->getTotal());
          
        }
        //新增广告
         private function add(){
            if(isset($_POST['send'])){
                if(Validate::checkNull($_POST['title'])) Tool::alertBack('广告标题不得为空');
                if(Validate::checkNull($_POST['link'])) Tool::alertBack('广告链接不得为空');
                if(Validate::checkLength($_POST['title'], 20, max)) Tool::alertBack('广告标题不得大于20位');  
                if(Validate::checkLength($_POST['info'], 200, max)) Tool::alertBack('描述信息不得大于200位');
                if($_POST['adv']==2 || $_POST['adv']==3){
                    if(Validate::checkNull($_POST['thumb'])) Tool::alertBack('广告图片不得为空');
                    $this->model->thumb=$_POST['thumb'];
                }  
                $this->model->type=$_POST['type'];
                $this->model->link=$_POST['link'];
                $this->model->title=$_POST['title'];  
                $this->model->info=$_POST['info'];
                //if($this->model->getOneNav()) Tool::alertBack('此导航名称已存在');
                $this->model->addAdver()?Tool::alertLocation('新增广告成功', 'adver.inc.php?action=show') : Tool::alertBack('新增广告失败');
            }    
            $this->tpl->assign('add',true);
            $this->tpl->assign('title','新增广告');
        }
        //修改广告
        private function update(){
            if(isset($_GET['id'])){
                $this->model->id=$_GET['id'];
                $object=$this->model->getOneAdver();
                if(is_object($object)){
                    $this->tpl->assign('thumb',$object->thumb);
                    $this->tpl->assign('link',$object->link);
                    $this->tpl->assign('titler',$object->title);
                    $this->tpl->assign('info',$object->info);
                    $this->tpl->assign('update_id',$object->id);
                    switch($object->type){
                        case '1':   $this->tpl->assign('type1','checked="checked"');
                                    $this->tpl->assign('pic','style="display:none;"');
                                    break;
                        case '2':   $this->tpl->assign('type2','checked="checked"');
                                    $this->tpl->assign('pic','style="display:black;"');
                                    $this->tpl->assign('advertype',"<input type=\"button\" value=\"上传头部广告690x80\" onclick=\"centerWindow('../config/upfile.php?type=adver&size=690*80','upfile','400','200')\" />");
                                    break;
                        case '3':   $this->tpl->assign('type3','checked="checked"');
                                    $this->tpl->assign('pic','style="display:black;"');
                                    $this->tpl->assign('advertype',"<input type=\"button\" value=\"上传侧栏广告270x200\" onclick=\"centerWindow('../config/upfile.php?type=adver&size=270*200','upfile','400','200')\" />");
                                    break;
                    }
                }else{
                    Tool::alertBack('广告不存在');
                }
            
            }
            if(isset($_POST['id']) && isset($_POST['send'])){
                if(Validate::checkNull($_POST['title'])) Tool::alertBack('广告标题不得为空');
                if(Validate::checkNull($_POST['link'])) Tool::alertBack('广告链接不得为空');
                if(Validate::checkLength($_POST['title'], 20, max)) Tool::alertBack('广告标题不得大于20位');  
                if(Validate::checkLength($_POST['info'], 200, max)) Tool::alertBack('描述信息不得大于200位');
                if($_POST['type']==2 || $_POST['type']==3){
                    if(Validate::checkNull($_POST['thumb'])) Tool::alertBack('广告图片不得为空');
                    $this->model->thumb=$_POST['thumb'];
                }  
                $this->model->id=$_POST['id'];
                $this->model->type=$_POST['type'];
                $this->model->link=$_POST['link'];
                $this->model->title=$_POST['title'];  
                $this->model->info=$_POST['info'];
                $this->model->updateAdver()?Tool::alertLocation('修改广告成功', $_POST['prev_url']) : Tool::alertBack('修改广告失败');            
            }
            $this->tpl->assign('update',true);
            $this->tpl->assign('title','修改广告');
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
        //生成js文件
        private function js(){
            if(isset($_GET['type'])){
                switch ($_GET['type']){
                    case '1':  $object=$this->model->getNewTextAdver(); 
                               if($object){
                                   $j=0;
                                   $js.="var text=[];\r\n";
                                   foreach ($object as $value){
                                       $j++;
                                       $js.="text['$j']={\r\n"; 
                                       $js.="'title':'$value->title',\r\n";
                                       $js.="'link':'$value->link'\r\n" ;
                                       $js.="};\r\n";
                                   }
                                   $js.="var i=Math.floor(Math.random()*$j+1);\r\n";
                                   $js.="document.write('<a class=\"adv\" href=\"'+text[i].link+'\" target=\"_blank\">'+text[i].title+\"</a>\");";
                                   if(!file_put_contents('../js/adver_text.js', $js)){
                                       Tool::alertBack('生成文字广告js失败');
                                   }else{
                                       Tool::alertBack('生成文字广告js成功');
                                   } 
                               }
                               break;
                   case '2':   $object=$this->model->getNewHeaderAdver(); 
                               if($object){
                                   $j=0;
                                   $js.="var text=[];\r\n";
                                   foreach ($object as $value){
                                       $j++;
                                       $js.="text['$j']={\r\n"; 
                                       $js.="'thumb':'$value->thumb',\r\n";
                                       $js.="'link':'$value->link'\r\n" ;
                                       $js.="};\r\n";
                                   }
                                   $js.="var i=Math.floor(Math.random()*$j+1);\r\n";
                                   $js.="document.write('<a class=\"adv\" href=\"'+text[i].link+'\" target=\"_blank\">'+'<img src=\"'+text[i].thumb+'\"></img>'+\"</a>\");";
                                   if(!file_put_contents('../js/adver_header.js', $js)){
                                       Tool::alertBack('生成头部广告js失败');
                                   }else{
                                       Tool::alertBack('生成头部广告js成功');
                                   } 
                               }
                               break;
                   case '3':   $object=$this->model->getNewSidbarAdver(); 
                               if($object){
                                   $j=0;
                                   $js.="var text=[];\r\n";
                                   foreach ($object as $value){
                                       $j++;
                                       $js.="text['$j']={\r\n"; 
                                       $js.="'thumb':'$value->thumb',\r\n";
                                       $js.="'link':'$value->link'\r\n" ;
                                       $js.="};\r\n";
                                   }
                                   $js.="var i=Math.floor(Math.random()*$j+1);\r\n";
                                   $js.="document.write('<a class=\"adv\" href=\"'+text[i].link+'\" target=\"_blank\">'+'<img src=\"'+text[i].thumb+'\"></img>'+\"</a>\");";
                                   if(!file_put_contents('../js/adver_sidbar.js', $js)){
                                       Tool::alertBack('生成侧栏广告js失败');
                                   }else{
                                       Tool::alertBack('生成侧栏广告js成功');
                                   } 
                               }
                               break;
                   default: Tool::alertBack('非法操作');
                }
            }
            
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
        //删除广告
        private function delete(){
            if(isset($_GET['id'])){
                $this->model->id=$_GET['id'];
                $this->model->deleteAdver()?Tool::alertLocation('删除广告成功', PREV_URL) : Tool::alertBack('删除广告失败');
            }
        } 
    }
?>