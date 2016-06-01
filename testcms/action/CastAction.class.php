<?php 
    //控制器类
    class CastAction extends Action{
        public function __construct(&$tpl){
            parent::__construct($tpl);
        }
        public function action(){
            $this->setCount();
            $this->getCount();
        }
        
        private function setCount(){
            if(isset($_POST['send'])){
                $vote=new VoteModel();
                if(empty($_POST['vote'])) Tool::alertClose('请选择一个项目');
                $vote->id=$_POST['vote'];
                $vote->vid=$_GET['id'];
                if($_COOKIE['ip']==$_SERVER['REMOTE_ADDR']){
                    if(time()-$_COOKIE['time']<86400) Tool::alertClose('您现在不能投票');
                }
                if(!$vote->setCount()) Tool::alertClose('投票失败');
                setcookie('ip',$_SERVER['REMOTE_ADDR']);
                setcookie('time',time());
                Tool::alertLocation('投票成功,感谢您的参与', 'cast.php?id='.$vote->vid.'');
            }
        }
        
        private function getCount(){
            if(isset($_GET['id'])){
                $vote=new VoteModel();
                $vote->id=$_GET['id'];
                $object=$vote->getOneVote();
                if($object){
                    $this->tpl->assign('titlev',$object->title);
                    $vote->vid=$object->id;
                    $width=400;
                    $i=0;
                    $total=$vote->getCountTotal()->c;
                    $Item=$vote->getOneFrontVoteItem();
                    if($Item){
                        $this->tpl->assign('item',$Item);
                        foreach ($Item as $value){
                            $value->percent=round(($value->count/$total)*100,2).'%';
                            $value->picwidth=($value->count/$total)*$width;
                            $i++;
                            $value->picnum=$i;
                        }
                        $this->tpl->assign('width',$width);
                    }
                }
            }
        }
    }
?>