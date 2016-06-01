<?php 
    //控制器基类
    class Action{
        protected $tpl;
        protected $model;
        
        protected function __construct(&$_tpl, &$_model=null) {
            $this->tpl = $_tpl;
            $this->model = $_model;
        }
        
        protected function page($total,$size=PAGESIZE,$type=1){          
                $page=new Page($total,$size);
                $this->model->limit=$page->limit;
                $this->tpl->assign('page', $page->showPage($type));
                $this->tpl->assign('pagesize',$page->start);
            
        }
    }
?>