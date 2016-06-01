<?php 
    //控制器类
    class ListAction extends Action{
        public function __construct(&$tpl){
            parent::__construct($tpl);
        }
        //获取前台列表显示
        public function getFrontList(){
            if(isset($_GET['id'])){
                parent::__construct($this->tpl,new ContentModel());
                $this->model->id=$_GET['id'];
                if($this->model->getTotalList()){
                    parent::page($this->model->getTotalList(),ARTICLESIZE,1);
                }
                $object=$this->model->getAllChildList();
                $object1=$this->model->getChildMonthNavRec();
                $object2=$this->model->getChildMonthNavHot();
                $object3=$this->model->getChildMonthNavPic();
                if(!$object || !$object1 || !$object2 || !$object3){
                    $this->model->nav=$_GET['id'];
                    if($this->model->getChildTotalList()){
                        parent::page($this->model->getChildTotalList(),ARTICLESIZE,1);
                    }
                    if($this->model->getAllList()){
                        $object=$this->model->getAllList();
                    }
                    if($this->model->getMonthNavRec()){
                        $object1=$this->model->getMonthNavRec();  
                        $object2=$this->model->getMonthNavHot();
                        $object3=$this->model->getMonthNavPic();
                    }
                }  
                    $object=Tool::subStr($object, 'title', 35, 'utf-8');
                    $object=Tool::subStr($object, 'info', 120, 'utf-8');
                    foreach ($object as $value){
                        if(empty($value->thumb)){
                            $value->thumb='images/none.jpg';
                        }
                    }
                    foreach ($object1 as $value){
                        $value->date=date('m-d',strtotime($value->date));
                    }
                    foreach ($object2 as $value){
                        $value->date=date('m-d',strtotime($value->date));
                    }
                    foreach ($object3 as $value){
                        $value->date=date('m-d',strtotime($value->date));
                    }
                    if(IS_CACHE){
                        foreach ($object as $value){
                            $value->count='<script type="text/javascript">getContentCount()</script>';
                        }
                    }
                    $this->tpl->assign('frontlist',$object);
                    $this->tpl->assign('MonthNavRec',$object1);
                    $this->tpl->assign('MonthNavHot',$object2);
                    $this->tpl->assign('MonthNavPic',$object3);
            }else{
                Tool::alertBack('非法操作');
            }
        }
        //显示前台导航
        public function getNav(){
            if(isset($_GET['id'])){
                $nav=new NavModel();
                $nav->id=$_GET['id'];
                if($nav->getOneNav()){
                    //获取子导航的主类名称
                    if($nav->getMainNav()){
                        $MainNavName='<a href="list.php?id='.$nav->getMainNav()->id.'">'.$nav->getMainNav()->nav_name.'</a>'.'&gt;';
                    }
                    //主导航
                    $nav_name='<a href="list.php?id='.$nav->getOneNav()->id.'">'.$nav->getOneNav()->nav_name.'</a>';
                    $this->tpl->assign('nav', $MainNavName.$nav_name);
                    //子导航
                    $this->tpl->assign('childNav', $nav->getChildAllNav());
                    
                }else{
                    Tool::alertBack('此导航不存在');
                }
            }else{
                Tool::alertBack('非法操作');
            }
        }
        
    }
?>