<?php 
    class RotationModel extends Model{      
        public $thumb;
        public $link;
        public $title;
        public $limit;
        public $info;
         //拦截器__set()
//         public function __set($_key,$_value){
//             $this->_key=Tool::addString($_value);
//         }
//         //拦截器__get()
//         public function __get($_key){
//             return $this->_key;
//         } 
        //获取单个轮播图
         public function getOneRotation(){
            $sql="select id,title,info,link,thumb
                from cms_rotation
                where id='$this->id'";
           return parent::one($sql);            
        } 
        //获取轮播图数据总数
        public function getTotal(){
            $sql="select id from cms_rotation";
            return parent::total($sql);
        }
        //获取全部轮播图,带limit       
        public function getAllRotation(){                       
            $sql="select id,title,link,link full,state from cms_rotation order by state desc,date desc
                  $this->limit";
            return parent::all($sql);       
        }
        //获取最新3条轮播图
        public function getNewRotation(){
            $sql="select id,link,thumb from cms_rotation where state=1 order by date desc
                        limit 0,".RO_NUM;
            return parent::all($sql);
        }
        //修改轮播图
         public function updateRotation(){
            $this->title=Tool::addString($this->title);
            $this->info=Tool::addString($this->info);
            $sql="update cms_rotation
                        set thumb='$this->thumb',
                            link='$this->link',
                            title='$this->title',
                            info='$this->info'
                        where id=$this->id";
            return parent::asu($sql);            
            
        }
        //新增轮播图
        public function addRotation(){
            $this->title=Tool::addString($this->title);
            $this->info=Tool::addString($this->info);
            $sql="insert into cms_rotation(
                thumb,
                title,
                link,
                info,
                state,
                date)
                values(
                '$this->thumb',
                '$this->title',
                '$this->link',
                '$this->info',
                1,
                NOW())";           
            return parent::asu($sql);            
        }
        //设置轮播通过
        public function setStateOk(){
            $sql="update cms_rotation set state=1 where id='$this->id'";
            return parent::asu($sql);
        }
        //设置轮播取消
        public function setStateCancel(){
            $sql="update cms_rotation set state=0 where id='$this->id'";
            return parent::asu($sql);
        }
        //删除轮播图
        public function deleteRotation(){        
           $sql="delete from cms_rotation where id=$this->id";
           return parent::asu($sql);
        }
    
        
    }
?>