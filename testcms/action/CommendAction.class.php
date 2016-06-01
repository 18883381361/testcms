<?php 
    //控制器类
    class CommendAction extends Action{
        public function __construct(&$tpl){
            parent::__construct($tpl, new CommendModel());
        }
        public function action(){
            switch ($_GET['action']){
                case 'show' :
                    $this->show();
                    break;
                case 'state' :
                    $this->state();
                    break;
                case 'delete' :                   
                    $this->delete();
                    break;
                default:
                    echo '非法操作!';
                    exit();
            }            
        }
        private function show(){
            if(!!$total=$this->model->getAllContentCommendTotal()){
                parent::page($total);
            }
            $object=$this->model->getAllContentCommend();
            foreach ($object as $value){
                Tool::subStr($object, 'content', 15, 'utf-8');
                if(empty($value->state)){
                    $value->state='<span style="color:red">[未审核]</span>'.' | '.'<a href="?action=state&type=ok&id='.$value->id.'">通过</a>';
                }else{
                    $value->state='<span style="color:green">[已审核]</span>'.' | '.'<a href="?action=state&type=cancel&id='.$value->id.'">取消</a>';
                }
            }
            $this->tpl->assign('show',true);
            $this->tpl->assign('title','评论列表');
            $this->tpl->assign('allCommend',$object);
            
        }
       //审核
       private function state(){
           //单条审核
           if(isset($_GET['id'])){
               $this->model->id=$_GET['id'];
               if($_GET['type']=='ok'){                   
                   if($this->model->setStateOk()){
                       Tool::alertLocation(null, PREV_URL);
                   }else{
                       Tool::alertBack('审核通过失败');
                   }
               }elseif($_GET['type']=='cancel'){
                   if($this->model->setStateCancel()){
                       Tool::alertLocation(null, PREV_URL);
                   }else{
                       Tool::alertBack('审核取消失败');
                   }
               }else{
                   Tool::alertBack('非法操作');
               }
           }
           //批量审核
           if(isset($_POST['send'])){
                $this->model->states=$_POST['state'];
                $this->model->setStates();
                if($this->model->setStates()){
                    Tool::alertLocation(null, PREV_URL);
                }else{
                    Tool::alertBack('审核失败');
                }
           }
           
       }
        private function delete(){
            if(isset($_GET['id'])){
                $this->model->id=$_GET['id'];
                if($this->model->deleteCommend()){
                    Tool::alertLocation('评论删除成功', '?action=show');
                }else{
                    Tool::alertBack('评论删除失败');
                }
            }else{
                Tool::alertBack('该评论不存在');
            }
        }      
    }
?>