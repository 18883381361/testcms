<?php 
    class ManageModel extends Model{      
        public $admin_user;
        public $admin_pass;
        public  $level;
        public  $id;
        public $limit;
        public $last_ip;
         //拦截器__set()
//         public function __set($_key,$_value){
//             $this->_key=Tool::addString($_value);
//         }
//         //拦截器__get()
//         public function __get($_key){
//             return $this->_key;
//         } 
        //获取单个管理员
        public function getOneManage(){
            $sql="select id,admin_user,admin_pass,level
                from cms_manage
                where id='$this->id' or admin_user='$this->admin_user'";
           return parent::one($sql);            
        }
        //获取数据总数
        public function getTotal(){
            $sql="select id from cms_manage";
            return parent::total($sql);
        }
        //获取全部管理员        
        public function getAllManage(){            
          //查询语句
            
            $sql="select m.id,
                         m.admin_user,
                         m.login_count,
                         m.last_ip,
                         m.last_time,
                         l.level_name    
                  from cms_manage as m,cms_level as l
                  where l.level=m.level
                  order by m.id desc
                  $this->limit";
            return parent::all($sql);       
        }
        //获取所有等级
        public function getAllLevel(){
            $sql="select level,level_name from cms_level order by level asc";
            return parent::all($sql);
        }
        
        //修改管理员
        public function updateManage(){
            $this->admin_user=Tool::addString($this->admin_user);
            if(!empty($this->admin_pass)){
                $sql="update cms_manage
                                set admin_user='$this->admin_user',
                                    admin_pass='$this->admin_pass',
                                    level='$this->level'
                                where id=$this->id";
                return parent::asu($sql);
            }else{
                $sql="update cms_manage
                    set admin_user='$this->admin_user',                
                    level='$this->level'
                    where id=$this->id";
                return parent::asu($sql);            
            }
        }
        //新增管理员
        public function addManage(){
            $this->admin_user=Tool::addString($this->admin_user);
            $sql="insert into cms_manage(
                admin_user,
                admin_pass,
                level,
                reg_time)
                values(
                '$this->admin_user',
                '$this->admin_pass',
                '$this->level',
                NOW())";
            return parent::asu($sql);            
        }
        //删除管理员
        public function deleteManage(){        
           $sql="delete from cms_manage where id=$this->id";
           return parent::asu($sql);
        }
        
        //统计登录次数、最近登录时间、最近登录IP
        public function setCount(){
            $sql="update cms_manage 
                        set 
                login_count=login_count+1,
                last_ip='$this->last_ip',
                last_time=NOW()
                where admin_user='$this->admin_user'";
            return parent::asu($sql);
        }
    }
?>