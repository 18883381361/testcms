<?php 
    class CommendModel extends Model{      
        public $username;
        public $content;
        public $manner;
        public $cid;
        public $support;
        public $oppose;
        public $id;
        public $limit;
        public $states=array();
        //获取某篇文章的所有评论(前台)
        public function getAllCommend(){
            $sql="select c.id,c.cid,c.username,c.content,c.support,c.oppose,c.date,c.manner,u.face from 
                        cms_commend as c
                     left join
                        cms_user as u
                     on c.username=u.username
                    where 
                        c.cid='$this->cid' 
                    and c.state=1
                order by date desc $this->limit";
           return parent::all($sql);
        }
       
        //获取单一文档内容
        public function getOneList(){
            $sql="select * from cms_content where id=$this->id";
            return parent::one($sql);
        }
        //获取某篇文章评论总数(前台)
        public function getTotal(){
            $sql="select id from cms_commend where 
            cid='$this->cid'
            and state=1";
            return parent::total($sql);
        }
        //获取某篇文章最新3条评论(前台)
        public function getNewCommend(){
            $sql="select c.id,c.cid,c.username,c.content,c.support,c.oppose,c.date,c.manner,u.face from
            cms_commend as c
            left join
            cms_user as u
            on c.username=u.username
            where
            c.cid='$this->cid' 
            and c.state=1
            order by date desc limit 0,3";
            return parent::all($sql);
        }
        //获取某篇文章最热3条评论(前台)
        public function getHotCommend(){
            $sql="select c.id,c.cid,c.username,c.content,c.support,c.oppose,c.date,c.manner,u.face from
            cms_commend as c
            left join
            cms_user as u
            on c.username=u.username
            where
            c.cid='$this->cid' 
            and c.support+c.oppose>0 
            and c.state=1
            order by c.support+c.oppose desc limit 0,3";
            return parent::all($sql);
        }
        //获取评论量最多的20篇文档
        public function getContentMostCommend(){
            $sql="select ct.id,ct.title 
                    from cms_content as ct 
                    order by 
                        (select count(*) from cms_commend as c where c.cid=ct.id)
                        desc limit 0,20";
            return parent::all($sql);
        }
        //获取所有评论(后台)
        public function getAllContentCommend(){
            $sql="select c.id,c.cid,c.content,c.content full,c.username,c.state,c.state s,ct.title
                    from cms_commend c,cms_content ct
                    where ct.id=c.cid
                    order by c.date desc
                    $this->limit";
            return parent::all($sql);
        }
        //获取评论总数(后台)
        public function getAllContentCommendTotal(){
            $sql="select id from cms_commend";
            return parent::total($sql);
        }
       //新增评论
        public function addCommend(){
            $this->addstring();           
            $sql="insert into cms_commend(
            username,
            content,
            manner,
            cid,
            date)
            values(
            '$this->username',
            '$this->content',
            '$this->manner',
            '$this->cid',
            NOW())";
            return parent::asu($sql);
        }   
        //更新支持率
        public function support(){
            $sql="update cms_commend set support=support+1 where id='$this->id' && cid='$this->cid'";
            return parent::asu($sql);
        } 
        //更新反对率
        public function oppose(){
            $sql="update cms_commend set oppose=oppose+1 where id='$this->id' && cid='$this->cid'";
            return parent::asu($sql);
        } 
        //设置审核通过
        public function setStateOk(){
            $sql="update cms_commend set state=1 where id='$this->id'";
            return parent::asu($sql);
        } 
        //设置审核取消
        public function setStateCancel(){
            $sql="update cms_commend set state=0 where id='$this->id'";
            return parent::asu($sql);
        }
        //批量审核
        public function setStates(){
            print_r($this->states);
            foreach ($this->states as $key=>$value){
               if(!is_numeric($value)) continue;
               if($value>0){
                   $value=1;
               }else{
                   $value=0;
               }
                $sql.="update cms_commend set state='$value' where id='$key';";
            }
            return parent::multi($sql);
        }
        //删除评论
        public function deleteCommend(){
            $sql="delete from cms_commend where id='$this->id'";
            return parent::asu($sql);
        }
        //addstring
        private function addstring(){
            $this->content=Tool::addString($this->content);           
        }
    }
?>