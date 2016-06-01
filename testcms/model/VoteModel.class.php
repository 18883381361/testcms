<?php 
    class VoteModel extends Model{      
        public $title;
        public $info;
        public $id;
        public $limit;
        public $vid;
        public $sort=array();
         //拦截器__set()
//         public function __set($_key,$_value){
//             $this->_key=Tool::addString($_value);
//         }
//         //拦截器__get()
//         public function __get($_key){
//             return $this->_key;
//         } 
        //获取单个投票主题
         public function getOneVote(){
            $sql="select id,title,info
                from cms_vote
                where id='$this->id' or title='$this->title'";
           return parent::one($sql);            
        } 
        //获取某投票主题下的一个项目
        public function getOneVoteX(){
            $sql="select id,title,info
            from cms_vote
            where title='$this->title' and vid='$this->vid'";
            return parent::one($sql);
        }
        //获取投票主题数据总数
        public function getTotal(){
            $sql="select id from cms_vote where vid=0";
            return parent::total($sql);
        }
        //获取全部投票主题,带limit       
        public function getAllVote(){                       
            $sql="select c.id,c.title,c.info,c.state,
                    (select SUM(count) from cms_vote where vid=c.id) pcount
                    from cms_vote c
                    where c.vid=0 order by c.state desc,c.date desc
                  $this->limit";
            return parent::all($sql);       
        }
        //获取投票项目数据
        public function getChildTotal(){
            $sql="select id from cms_vote where vid='$this->id'";
            return parent::total($sql);
        }
        //获取投票项目,带limit
        public function getChildAllVote(){
            $sql="select id,title,info,count from cms_vote where vid='$this->id' order by date desc
            $this->limit";
            return parent::all($sql);
        }
        //获取前台显示的一个主题的标题
        public function getOneFrontVoteTitle(){
            $sql="select id,title 
                        from cms_vote 
                        where state=1 and vid=0 
                        limit 1";
            return parent::one($sql);
        }
        //获取前台显示的一个主题的项目
        public function getOneFrontVoteItem(){
            $sql="select id,title,count
                        from cms_vote
                        where vid='$this->vid'";
            return parent::all($sql);
        }
        //统计某个主题的项目投票总数
        public function getCountTotal(){
            $sql="select SUM(count) as c
                    from cms_vote
                    where vid='$this->vid'";
            return parent::one($sql);
        }
        //设置项目count
        public function setCount(){
            $sql="update cms_vote 
                       set count=count+1
                       where id='$this->id' and vid='$this->vid'";
            return parent::asu($sql);
        }
        //修改投票主题
         public function updateVote(){
            $this->title=Tool::addString($this->title);
            $this->info=Tool::addString($this->info);          
            $sql="update cms_vote
                        set title='$this->title',
                            info='$this->info'
                        where id=$this->id";
            return parent::asu($sql);            
            
        }
        //新增投票主题
        public function addVote(){
            $this->title=Tool::addString($this->title);
            $this->info=Tool::addString($this->info);
            $sql="insert into cms_vote(
                title,
                info,
                vid,
                date)
                values(
                '$this->title',
                '$this->info',
                0,
                NOW())";           
            return parent::asu($sql);            
        }
        //新增投票项目
        public function addChildVote(){
            $this->title=Tool::addString($this->title);
            $this->info=Tool::addString($this->info);
            $sql="insert into cms_vote(
            title,
            info,
            vid,
            date)
            values(
            '$this->title',
            '$this->info',
            '$this->vid',
            NOW())";
            return parent::asu($sql);
        }
        //设置审核通过
        public function setStateOk(){
            $sql="update cms_vote set state=1 where id='$this->id'";
            return parent::asu($sql);
        }
        //设置审核取消
        public function setStateCancel(){
            $sql="update cms_vote set state=0 where state=1";
            return parent::asu($sql);
        }
        //删除投票主题或项目
        public function deleteVote(){        
           $sql="delete from cms_vote where id=$this->id or vid='$this->id'";
           return parent::asu($sql);
        }
    
        
    }
?>