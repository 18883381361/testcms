<?php 
    class PremissionModel extends Model{      
        public $name;
        public $info;
        public $id;
        public $limit;
         //拦截器__set()
//         public function __set($_key,$_value){
//             $this->_key=Tool::addString($_value);
//         }
//         //拦截器__get()
//         public function __get($_key){
//             return $this->_key;
//         } 
        //获取一个权限
         public function getOnePremission(){
            $sql="select id,name,info
                from cms_premission
                where id='$this->id' or name='$this->name'";
           return parent::one($sql);            
        } 
        //获取权限数据总数
        public function getTotal(){
            $sql="select id from cms_premission";
            return parent::total($sql);
        }


        //获取全部权限,带limit       
        public function getAllPremission(){                       
            $sql="select id,name,info from cms_premission order by id desc
                  $this->limit";
            return parent::all($sql);       
        }
        //获取全部权限,不带limit
        public function getAllNoLimitPremission(){
            $sql="select id,name,info from cms_premission order by id asc";
            return parent::all($sql);
        }

        //修改权限
         public function updatePremission(){
            $this->name=Tool::addString($this->name);
            $this->info=Tool::addString($this->info);          
            $sql="update cms_premission
                        set name='$this->name',
                            info='$this->info'
                        where id=$this->id";
            return parent::asu($sql);            
            
        }
        //新增权限
        public function addPremission(){
            $this->premission_name=Tool::addString($this->premission_name);
            $this->premission_info=Tool::addString($this->premission_info);
            $sql="insert into cms_premission(
                name,
                info)
                values(
                '$this->name',
                '$this->info')";           
            return parent::asu($sql);            
        }
        //删除权限
        public function deletePremission(){        
           $sql="delete from cms_premission where id=$this->id";
           return parent::asu($sql);
        }
    
        
    }
?>