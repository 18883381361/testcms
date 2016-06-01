<?php 
    class Cache{
        //details
        public function details(){
            $content=new ContentModel();
            $content->id=$_GET['id'];
            $this->setCount($content);
            $this->getCount($content);
            $commend=new CommendModel();
            $commend->cid=$_GET['id'];
            $this->getCommendCount($commend);
        }
        //list
        public function listc(){
            $content=new ContentModel();
            $content->id=$_GET['id'];
            $this->getCount($content);
        }
        //index
        public function index(){
            $this->getLogin();
        }
        //header
        public function header(){
            $this->getHeaderUser();
        }
        //设置点击量
        private function setCount($content){
            $content->setContentCount();
        }
        //获取评论量
        private function getCommendCount($commend){
            $count=$commend->getTotal();
            echo "function getCommendCount(){
                    document.write('$count');
                }";
        }
        //获取点击量
        private function getCount($content){
            $count=$content->getOneList()->count;
            echo "
            function getContentCount(){
            document.write('$count');
            }";
        }
        //标头的会员信息
        private function getHeaderUser(){
            if(isset($_COOKIE['user'])){
                $header.='<span>欢迎您['.$_COOKIE['user'].']　<a href="register.php?action=logout">退出</a></span>';
            }else{
                $header.='<a href="register.php?action=reg" class="user">注册</a>';
                $header.='<a href="register.php?action=login" class="user">登录</a>';
            }
            echo "function getHeaderLoginUser(){
                      document.write('$header');
                }";
        }
        //登录
        private function getLogin(){
            $user=new UserModel();
            $user->username=$_COOKIE['user'];
            $str=mb_substr($_COOKIE['user'], 0,13,'utf-8');
            $face=$user->getOneUser()->face;
            if($user->username && $face){
                $member.='<h2>会员信息</h2>';            
                $member.='<div class="a">您好,<strong>'.$str.'</strong> 欢迎光临</div>';
                $member.='<div class="b">';
                $member.='<dl class="a"><img src="images/'.$face.'" alt="头像"/></dl>';
                $member.='<dl class="b">';
                $member.='<dd><a href="###">个人中心</a></dd>';
                $member.='<dd><a href="###">我的评论</a></dd>';
                $member.='<dd><a href="register.php?action=logout">退出登录</a></dd>';
                $member.='</dl>';
                $member.=' </div>';
            }else{
                $member.='<h2>会员登录</h2>'; 
                $member.='<form method="post" action="register.php?action=login" name="login">'; 
                $member.='<dl>'; 
                $member.='<dd>用户名:<input type="text" name="username" class="text" ></input></dd>'; 
                $member.='<dd>密　码:<input type="password" name="password" class="text"></input></dd>'; 
                $member.='<dd>验证码:<input type="text" name="code" class="code"></input><img alt="验证码" src="config/code.php" id="code" onclick="freshCode()"></dd>'; 
                $member.='<dd><input type="submit" name="send" onclick="return checkLogin()" value="登录" class="submit"/> <a href="register.php?action=reg">注册会员</a> <a href="###">忘记密码?</a></dd>'; 
                $member.='</dl>'; 
               $member.='</form>'; 
            }
            echo "function getLoginUser(){
                    document.write('$member');
                }";
        }
    }
?>