<?php 
    class Page{
        public $total;//总条数
        public $limit;
        public $pagesize;//每页显示多少条
        public $page;//页码
        public $start;//每页开始的值
        public $totalPage;//总页数
        public $pagenum;//每页数字分页的量
        public $url;
        public function __construct($total,$pagesize){ 
            $this->url=$this->getPath();         
            $this->total=$total; 
            $this->pagesize=$pagesize;
            $this->page=$this->setPage();
            $this->start=$this->pagesize*($this->page-1);
            $this->limit='limit '.$this->start.','.$pagesize;
            $this->pagenum=5;          
        }
        //获取地址
        public function getPath(){
            $path= $_SERVER['REQUEST_URI'];
            $par=parse_url($path);
            if(isset($par['query'])){
                parse_str($par['query'],$query);
                unset($query['page']);
                $url=$par['path'].'?'.http_build_query($query);
            }
            return $url;
        }
        //设置分页信息
        public function setPage(){
            $page=$_GET['page'];
            $this->totalPage=ceil($this->total/$this->pagesize);
            if(empty($page) || $page<0 || !is_numeric($page)){
                $page=1;
            }
            if($page>$this->totalPage){
                $page=$this->totalPage;
            }
            return $page;
        }
        //数字分页
        public function pageList(){
                if($this->page!=1){  
                    $pageList.='<a href="'.$this->url.'&page='.($this->page-1).'">上一页</a>';
                }
                if($this->page<=ceil($this->pagenum/2)){  
                    for($j=1;$j<=$this->pagenum && $j<=$this->totalPage;$j++){                
                        $pageList.='<a href="'.$this->url.'&page='.$j.'">'.$j.'</a>';
                        $pageList.='<input type="hidden" title="'.$this->page.'"/>';           
                    }
                }else{
                    $page=$this->page-ceil($this->pagenum/2)+1;
                    if($page>$this->totalPage-$this->pagenum){
                        $page=$this->totalPage-$this->pagenum+2;
                    }
                    for($j=$page;$j<$page+$this->pagenum && $j<=$this->totalPage;$j++){
                        $pageList.='<a href="'.$this->url.'&page='.$j.'">'.$j.'</a>';
                        $pageList.='<input type="hidden" title="'.$this->page.'"/>';
                    }
                }
                if($this->page!=$this->totalPage){
                    $pageList.='<a href="'.$this->url.'&page='.($this->page+1).'">下一页</a>';
                }
            return $pageList;
        }
        //分页函数
        public function showPage($num){
            if($num==2){
                $html="总共有".$this->total."条数据 ";
                if($this->page==1){
                    $html .='首页 | 上一页
                         | <a href="'.$this->url.'&page='.($this->page+1).'">下一页</a>
                         | <a href="'.$this->url.'&page='.$this->totalPage.'">尾页</a>';
                }elseif($this->page==$this->totalPage){
                    $html .='<a href="'.$this->url.'&page=1">首页</a>
                         | <a href="'.$this->url.'&page='.($this->page-1).'">上一页</a>
                         | 下一页
                         | 尾页';
                }else{
                    $html .='<a href="'.$this->url.'&page=1">首页</a> 
                             | <a href="'.$this->url.'&page='.($this->page-1).'">上一页</a> 
                             | <a href="'.$this->url.'&page='.($this->page+1).'">下一页</a> 
                             | <a href="'.$this->url.'&page='.$this->totalPage.'">尾页</a>';
                }
            }else{
                $html=$this->pageList();
            }
            
            return $html;
        }
    }
?>