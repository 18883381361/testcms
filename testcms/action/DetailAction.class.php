<?php 
    //控制器类
    class DetailAction extends Action{
        public function __construct(&$tpl){
            parent::__construct($tpl);
        }
        
        
        //获取文档内容
        public function getDetails(){
            if(isset($_GET['id'])){
                parent::__construct($this->tpl,new ContentModel());
                $this->model->id=$_GET['id'];                  
                if(!$this->model->setContentCount()) Tool::alertBack('查询文档失败');
                $list=$this->model->getOneList();
                $this->tpl->assign('listTitle',$list->title);
                $this->tpl->assign('date',$list->date);
                $this->tpl->assign('source',$list->source);
                $this->tpl->assign('author',$list->author);
                $tag=explode('，', $list->tag);
                foreach ($tag as $value){
                    $list->tag=str_replace($value,'<a href="search.php?type=3&inputkeyword='.$value.'" target="_blank">'.$value.'</a>', $list->tag);
                }
                $this->tpl->assign('tag',$list->tag);
                $commend=new CommendModel();
                $commend->cid=$_GET['id'];
                $newCommend=$commend->getNewCommend();
                
                if($newCommend){
                    foreach ($newCommend as $value){
                        switch ($value->manner){
                            case '-1':  $value->manner='反对';
                                        break;
                            case '0' :  $value->manner='中立';
                                        break;
                            case '1' :  $value->manner='支持';
                                        break;
                        }
                        if($value->username=='游客'){
                            $value->face='00.gif';
                        }
                    }
                    $this->tpl->assign('newCommend',$newCommend);
                }
                if(IS_CACHE){
                    $this->tpl->assign('count','<script type="text/javascript">getContentCount();</script>');
                    $this->tpl->assign('commendTotal','<script type="text/javascript">getCommendCount();</script>');
                }else{
                    $this->tpl->assign('count',$list->count);
                    if(!!$total=$commend->getTotal()){
                        $this->tpl->assign('commendTotal',$total);
                    }else{
                        $this->tpl->assign('commendTotal',0);
                    }
                }
                $this->tpl->assign('info',$list->info);
                $this->tpl->assign('id',$list->id);
                $this->tpl->assign('content',htmlspecialchars_decode($list->content));
                $this->getNav($list->nav);
                $this->model->nav=$list->nav;
                $object1=$this->model->getMonthNavRec();
                $object2=$this->model->getMonthNavHot();
                $object3=$this->model->getMonthNavPic();
                foreach ($object1 as $value){
                    $value->date=date('m-d',strtotime($value->date));
                }
                foreach ($object2 as $value){
                    $value->date=date('m-d',strtotime($value->date));
                }
                foreach ($object3 as $value){
                    $value->date=date('m-d',strtotime($value->date));
                }
                $this->tpl->assign('MonthNavRec',$object1);
                $this->tpl->assign('MonthNavHot',$object2);
                $this->tpl->assign('MonthNavPic',$object3);
            }else{
                Tool::alertBack('此文档不存在');
            }
        }
        
        //显示前台导航
        public function getNav($id){
                $nav=new NavModel();
                $nav->id=$id;
                if($nav->getOneNav()){
                    //获取子导航的主类名称
                    if($nav->getMainNav()){
                        $MainNavName='<a href="list.php?id='.$nav->getMainNav()->id.'">'.$nav->getMainNav()->nav_name.'</a>'.'&gt;';
                    }
                    //主导航
                    $nav_name='<a href="list.php?id='.$nav->getOneNav()->id.'">'.$nav->getOneNav()->nav_name.'</a>';
                    $this->tpl->assign('nav', $MainNavName.$nav_name);
                    //子导航
                    //$nav->getChildAllNav();
                    $this->tpl->assign('childNav', $nav->getChildAllNav());
        
                }else{
                    Tool::alertBack('此导航不存在');
                }
        }
        
        
        
    }
?>