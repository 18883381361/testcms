<?php 
    class LevelModel extends Model{      
        public $level;
        public $level_name;
        public  $level_info;
        public  $id;
        public $premission;
   /*      //拦截器__set()
        public function __set($_key,$_value){
            $this->_key=$_value;
        }
        //拦截器__get()
        public function __get($_key){
            return $this->_key;
        } */
        //获取所有数据
        public function getTotal(){
            $sql="select id from cms_level";
            return parent::total($sql);
        }
        //获取单个等级
        public function getOneLevel(){
            $sql="select id,level_name,level_info,level,premission
                from cms_level
                where id='$this->id' or level_name='$this->level_name' or level='$this->level'";
           return parent::one($sql);            
        }
        //获取所有等级
        public function getAllLevel(){
            $sql="select id,level,level_name,level_info,premission from cms_level order by level desc";
            return parent::all($sql);
        }
        
        //修改等级
        public function updateLevel(){
                $this->level_name=Tool::addString($this->level_name);
                $this->level_info=Tool::addString($this->level_info);
                $sql="update cms_level
                                set level='$this->level',
                                    level_name='$this->level_name',
                                    level_info='$this->level_info',
                                    premission='$this->premission'
                                where id=$this->id";
                return parent::asu($sql);
            
        }
        //新增等级
        public function addLevel(){
            $this->level_name=Tool::addString($this->level_name);
            $this->level_info=Tool::addString($this->level_info);
            $sql="insert into cms_level(
                level_name,
                level_info,
                premission,
                level)
                values(
                '$this->level_name',
                '$this->level_info',
                '$this->premission',
                '$this->level'
               )";
            return parent::asu($sql);
            
        }
        //删除等级
        public function deleteLevel(){ 
           $sql="select level from cms_level
                        where id='$this->id'";
           $object=parent::one($sql);
           $sql1="select id from cms_manage where level='$object->level'";
           if(parent::one($sql1)){
               Tool::alertBack('您不能删除该等级,已有管理员使用了该等级');
           }else{       
                $sql="delete from cms_level where id=$this->id";
                return parent::asu($sql);
           }
        }
    }
?>