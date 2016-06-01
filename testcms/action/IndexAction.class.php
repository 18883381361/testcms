<?php 
class IndexAction extends Action{
    public function __construct(&$tpl){
        parent::__construct($tpl);
    }
    
    public function action(){
        $this->login();
        $this->lastLoginUser();
        $this->showRecHotCom();
        $this->showNavTop4();
        $this->showVote();
    }
    //登录模块
    private function login(){
        if(!isset($_COOKIE['user'])){
            $this->tpl->assign('login',true);
        }else{
            $user=new UserModel();
            $user->username=$_COOKIE['user']; 
            $str=mb_substr($_COOKIE['user'], 0,13,'utf-8');                   
            $this->tpl->assign('login',false);
            $this->tpl->assign('username',$str);
            $this->tpl->assign('face',$user->getOneUser()->face);
            $this->tpl->assign('cache',IS_CACHE);
            if(IS_CACHE) $this->tpl->assign('member','<script type="text/javascript">getLoginUser();</script>');
        }
    }
   //最近登录会员
   private function lastLoginUser(){
       $user=new UserModel();
       $this->tpl->assign('lastLoginUser',$user->getLastLoginUser());
   }
   //特别推荐、本月热点、本月评论、头条
   private function showRecHotCom(){
       parent::__construct($this->tpl,new ContentModel());
        //特别推荐
       $object1=$this->model->getNewRec();
       foreach ($object1 as $value){
           $value->date=date('m-d',strtotime($value->date));
           $object1=Tool::subStr($object1, 'title', 15, 'utf-8');
       }
       $this->tpl->assign('NewRec',$object1);
       //本月热点
       $object2=$this->model->getNewHot();
       foreach ($object2 as $value){
           $value->date=date('m-d',strtotime($value->date));
           $object2=Tool::subStr($object2, 'title', 15, 'utf-8');
       }
       $this->tpl->assign('NewHot',$object2);
       //本月评论
       $object3=$this->model->getNewCom();
       foreach ($object3 as $value){
           $value->date=date('m-d',strtotime($value->date));
           $object3=Tool::subStr($object3, 'title', 15, 'utf-8');
       }
       $this->tpl->assign('NewCom',$object3);
       //图文资讯
       $object4=$this->model->getNewPic();
       $this->tpl->assign('NewPic',$object4);
       //最新一条头条
       $object5=$this->model->getNewOneTop();
       $object5->info=mb_substr($object5->info, 0,87,'utf-8');
       $this->tpl->assign('NewOneTopTitle',$object5->title);
       $this->tpl->assign('NewOneTopInfo',$object5->info);
       $this->tpl->assign('id',$object5->id);
       //最新2-5条头条
       $object6=$this->model->getNewTop();
       foreach ($object6 as $value){
           $i=1;
           if($i/2==0){
               $value->line='<br/>';
           }else{
               $value->line=' | ';
           }
           $i++;
           $object6=Tool::subStr($object6, 'title', 14, 'utf-8');
           //$value->title=$value->title.$line;
       }
       $this->tpl->assign('NewTop',$object6);
       //最新10条文档
       $object7=$this->model->getNewDate();
       foreach ($object7 as $value){
           $value->date=date('Y-m-d',strtotime($value->date));
           $object7=Tool::subStr($object7, 'title', 25, 'utf-8');
       }
       $this->tpl->assign('NewDate',$object7);     
   }
   
   //显示前4个主导航
   private function showNavTop4(){
       parent::__construct($this->tpl,new NavModel());
       $object1=$this->model->getNavTop4();
       $this->tpl->assign('NavTop4',$object1);
       //获取某类的最新文档
       $content=new ContentModel();
       //$object2=array();
       foreach ($object1 as $value){
           $content->id=$value->id;         
           $value->list=$content->getOneListContent();
       }
       $this->tpl->assign('NavTop4',$object1);     
   }
   //显示投票
   private function showVote(){
       $vote=new VoteModel();
       $title=$vote->getOneFrontVoteTitle();
       if($title) $this->tpl->assign('votetitle',$title->title);
       $vote->vid=$title->id;
       $Item=$vote->getOneFrontVoteItem();
       if($Item){
           $this->tpl->assign('voteItem',$Item);
       }
       $this->tpl->assign('id',$vote->vid);
   }
  
}
?>