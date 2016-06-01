<?php 
    //控制器类
    class SearchAction extends Action{
        public function __construct(&$tpl){
            parent::__construct($tpl,new ContentModel());
        }
        public function action(){
            switch ($_GET['type']){
                case '1':   $this->searchTitle();
                            break;
                case '2':   $this->searchKeyword();
                            break;
                case '3':   $this->searchTag();
                            break;
                default:    Tool::alertBack('非法操作');
            }
        }
        //按标题搜索
        private function searchTitle(){
            $this->model->inputkeyword=$_GET['inputkeyword'];
            if($this->model->searchTitleTotal()){
                parent::page($this->model->searchTitleTotal(),2);
            }
            $object=$this->model->searchTitle();
            if($object){
                foreach ($object as $value){
                    $value->title=str_replace($this->model->inputkeyword, '<span style="color:red">'.$this->model->inputkeyword.'</span>', $value->title);
                }
                $this->tpl->assign('searchContent',$object);
            }
        }
        //按关键字搜索
        private function searchKeyword(){
            $this->model->inputkeyword=$_GET['inputkeyword'];
            if($this->model->searchKeywordTotal()){
                parent::page($this->model->searchKeywordTotal(),2);
            }
            $object=$this->model->searchKeyword();
            if($object){
                foreach ($object as $value){
                    echo $value->keyword;
                    $value->keyword=str_replace($this->model->inputkeyword, '<span style="color:red">'.$this->model->inputkeyword.'</span>', $value->keyword);
                }
                $this->tpl->assign('searchContent',$object);
            }
        }
        //按Tag标签搜索
        private function searchTag(){
            $this->model->inputkeyword=$_GET['inputkeyword'];
            $this->model->getOneTag() ? $this->model->setCount() : $this->model->addTag();
            if($this->model->searchTagTotal()){
                parent::page($this->model->searchTagTotal(),2);
            }
            $object=$this->model->searchTag();
            if($object){               
                $this->tpl->assign('searchContent',$object);
            }
        }
        //显示Tag标签
        public function showTag(){
            if($this->model->getTenTag()){
                $this->tpl->assign('tagList',$this->model->getTenTag());
            }
        }
    }
?>