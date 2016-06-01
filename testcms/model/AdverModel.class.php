<?php 
    class AdverModel extends Model{      
        public $thumb;
        public $link;
        public $title;
        public $limit;
        public $info;
        public $state;
        public $type;
         //拦截器__set()
//         public function __set($_key,$_value){
//             $this->_key=Tool::addString($_value);
//         }
//         //拦截器__get()
//         public function __get($_key){
//             return $this->_key;
//         } 
        //获取单个广告
         public function getOneAdver(){
            $sql="select id,title,info,link,thumb,type
                from cms_adver
                where id='$this->id'";
           return parent::one($sql);            
        } 
        //获取广告数据总数
        public function getTotal(){
            $sql="select id from cms_adver";
            return parent::total($sql);
        }
        //获取全部广告,带limit       
        public function getAllAdver(){                       
            $sql="select id,title,link,link full,state,type 
                        from cms_adver 
                        where type in($this->type)
                        order by state desc,date desc
                  $this->limit";
            return parent::all($sql);       
        }
        //获取最新N条文字广告
        public function getNewTextAdver(){
            $sql="select id,link,title from cms_adver 
                        where state=1 and type=1
                        order by date desc
                        limit 0,".ADVER_TEXT_NUM;
            return parent::all($sql);
        }
        //获取最新N条头部广告
        public function getNewHeaderAdver(){
            $sql="select id,link,thumb from cms_adver
                        where state=1 and type=2
                        order by date desc
                        limit 0,".ADVER_PIC_NUM;
            return parent::all($sql);
        }
        //获取最新N条侧栏广告
        public function getNewSidbarAdver(){
            $sql="select id,link,thumb from cms_adver
                        where state=1 and type=3
                        order by date desc
                        limit 0,".ADVER_PIC_NUM;
            return parent::all($sql);
        }
        //修改广告
         public function updateAdver(){
            $this->title=Tool::addString($this->title);
            $this->info=Tool::addString($this->info);
            $sql="update cms_adver
                        set thumb='$this->thumb',
                            link='$this->link',
                            title='$this->title',
                            info='$this->info'
                        where id=$this->id";
            return parent::asu($sql);            
            
        }
        //新增广告
        public function addAdver(){
            $this->title=Tool::addString($this->title);
            $this->info=Tool::addString($this->info);
            $sql="insert into cms_adver(
                thumb,
                title,
                link,
                info,
                type,
                state,
                date)
                values(
                '$this->thumb',
                '$this->title',
                '$this->link',
                '$this->info',
                '$this->type',
                1,
                NOW())";           
            return parent::asu($sql);            
        }
        //设置广告通过
        public function setStateOk(){
            $sql="update cms_adver set state=1 where id='$this->id'";
            return parent::asu($sql);
        }
        //设置广告取消
        public function setStateCancel(){
            $sql="update cms_adver set state=0 where id='$this->id'";
            return parent::asu($sql);
        }
        //删除广告
        public function deleteRotation(){        
           $sql="delete from cms_adver where id=$this->id";
           return parent::asu($sql);
        }
    
        
    }
?>