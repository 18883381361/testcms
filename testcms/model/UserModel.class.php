<?php 
    class UserModel extends Model{      
        public $username;
        public $password;
        public $email;
        public $question;
        public $answer;
        public $face;
        public $id;
        public $time;
        public $state=1;
        //获取单个用户
        public function getOneUser(){
            $sql="select id,username,password,face,email,state,question,answer
                from cms_user
                where id='$this->id' or username='$this->username'";
           return parent::one($sql);            
        }
        //获取全部会员信息,带limit
        public function getAllUser(){
            $sql="select id,username,email,state from cms_user $this->limit";
            return parent::all($sql);
        }
        //获取会员总数
        public function getTotal(){
            $sql="select id from cms_user";
            return parent::total($sql);
        }
        //修改最近登录时间
        public function setLastLoginTime(){
            $sql="update cms_user set time='$this->time' where username='$this->username'";
            return parent::asu($sql);
        }
        //获取最近登录的会员
        public function getLastLoginUser(){
            $sql="select id,face,username from cms_user order by time desc limit 0,6";
            return parent::all($sql);
        }
        //邮箱是否被注册过
        public function getOneEmail(){
            $sql="select id
            from cms_user
            where email='$this->email'";
            return parent::one($sql);
        }
        //修改会员
        public function updateUser(){
            $this->username=Tool::addString($this->username);
            if(!empty($this->password)){
                $sql="update cms_user
                    set 
                        username='$this->username',
                        password='$this->password',
                        email='$this->email',
                        question='$this->question',
                        answer='$this->answer',
                        state='$this->state',
                        face='$this->face',
                        time='$this->time'
                where id=$this->id";
            }else{
                $sql="update cms_user
                set
                username='$this->username',
                email='$this->email',
                question='$this->question',
                answer='$this->answer',
                state='$this->state',
                face='$this->face',
                time='$this->time'
                where id=$this->id";
            }
            return parent::asu($sql);
        
        }
        //注册会员
        public function addUser(){
            $this->username=Tool::addString($this->username);
            $sql="insert into cms_user(
                username,
                password,
                email,
                question,
                answer,
                state,
                face,
                time,
                date)
                values(
                '$this->username',
                '$this->password',
                '$this->email',
                '$this->question',
                '$this->answer',
                '$this->state',
                '$this->face',
                '$this->time',
                NOW())";           
            return parent::asu($sql);            
        }
       
        //删除会员
        public function deleteUser(){        
           $sql="delete from cms_user where id=$this->id";
           return parent::asu($sql);
        }
    
        
    }
?>