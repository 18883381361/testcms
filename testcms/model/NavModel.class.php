<?php 
    class NavModel extends Model{      
        public $nav_name;
        public $nav_info;
        public  $id;
        public $limit;
        public $pid;
        public $sort=array();
         //拦截器__set()
//         public function __set($_key,$_value){
//             $this->_key=Tool::addString($_value);
//         }
//         //拦截器__get()
//         public function __get($_key){
//             return $this->_key;
//         } 
        //获取单个导航
         public function getOneNav(){
            $sql="select id,nav_name,nav_info
                from cms_nav
                where id='$this->id' or nav_name='$this->nav_name'";
           return parent::one($sql);            
        } 
        //获取子导航的主导航名称
        public function getMainNav(){
            $sql="select n1.id,n1.nav_name,n2.id cid,n2.nav_name cname from 
                            cms_nav as n1
                        left join
                            cms_nav as n2
                        on
                            n2.pid=n1.id 
                        where n2.id='$this->id'";
            return parent::one($sql);
        }
        //获取主导航数据总数
        public function getTotal(){
            $sql="select id from cms_nav where pid=0";
            return parent::total($sql);
        }
        //导航排序
        public function setNavSort(){
            foreach ($this->sort as $key=>$value){
                if(!is_numeric($value)) continue;
                $sql .="update cms_nav set sort='$value' where id='$key';";
            }          
            return parent::multi($sql);
        }
        //获取前台导航
        public function getFrontNav(){
            $sql="select id,nav_name from cms_nav where pid=0 order by sort asc
            limit 0,".NAVSIZE;
            return parent::all($sql);
        }
        //获取全部主导航,带limit       
        public function getAllNav(){                       
            $sql="select id,nav_name,nav_info,sort from cms_nav where pid=0 order by sort asc
                  $this->limit";
            return parent::all($sql);       
        }
        //获取全部主导航,不带limit
        public function getAllNoLimitNav(){
            $sql="select id,nav_name from cms_nav where pid=0 order by sort asc";
            return parent::all($sql);
        }
        //获取前四个主导航
        public function getNavTop4(){
            $sql="select id,nav_name from cms_nav where pid=0 order by sort asc limit 0,4";
            return parent::all($sql);
        }
        //获取子导航数据
        public function getChildTotal(){
            $sql="select id from cms_nav where pid='$this->id'";
            return parent::total($sql);
        }
        //获取子导航,带limit
        public function getChildAllNav(){
            $sql="select id,nav_name,nav_info,sort from cms_nav where pid='$this->id' order by sort asc
            $this->limit";
            return parent::all($sql);
        }
        //获取子导航,不带limit
        public function getChildAllNoLimitNav(){
            $sql="select id,nav_name from cms_nav where pid='$this->id' order by sort asc";
            return parent::all($sql);
        }
        //修改导航
         public function updateNav(){
            $this->nav_name=Tool::addString($this->nav_name);
            $this->nav_info=Tool::addString($this->nav_info);          
            $sql="update cms_nav
                        set nav_name='$this->nav_name',
                            nav_info='$this->nav_info'
                        where id=$this->id";
            return parent::asu($sql);            
            
        }
        //新增导航
        public function addNav(){
            $this->nav_name=Tool::addString($this->nav_name);
            $this->nav_info=Tool::addString($this->nav_info);
            $sql="insert into cms_nav(
                nav_name,
                nav_info,
                pid,
                sort)
                values(
                '$this->nav_name',
                '$this->nav_info',
                0,
                ".parent::nextid('cms_nav').")";           
            return parent::asu($sql);            
        }
        //新增子导航
        public function addChildNav(){
            $this->nav_name=Tool::addString($this->nav_name);
            $this->nav_info=Tool::addString($this->nav_info);
            $sql="insert into cms_nav(
            nav_name,
            nav_info,
            pid,
            sort)
            values(
            '$this->nav_name',
            '$this->nav_info',
            '$this->pid',
            ".parent::nextid('cms_nav').")";
            return parent::asu($sql);
        }
        //删除导航
        public function deleteNav(){        
           $sql="delete from cms_nav where id=$this->id";
           return parent::asu($sql);
        }
    
        
    }
?>