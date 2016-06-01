<?php 
    //控制器类
    class LevelAction extends Action{
        public function __construct(&$tpl){
            parent::__construct($tpl, new LevelModel());
        }
        public function action(){
            switch ($_GET['action']){
                case 'show' :
                    $this->show();
                    break;
                case 'add' :
                    $this->add();
                    break;
                case 'update' :
                    $this->update();
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
            $this->tpl->assign('show',true);
            $this->tpl->assign('title','等级列表');
            $this->tpl->assign('level', $this->model->getAllLevel());
            $this->tpl->assign('total', $this->model->getTotal());
        }
        private function add(){
            if(isset($_POST['send'])){
                if(Validate::checkNull($_POST['level_name'])) Tool::alertBack('等级名称不得为空');
                if(Validate::checkLength($_POST['level_name'], 2, min)) Tool::alertBack('等级名称不得小于2位');
                if(Validate::checkLength($_POST['level_name'], 20, max)) Tool::alertBack('等级名称不得大于20位');
                if(Validate::checkLength($_POST['level_info'], 200, max)) Tool::alertBack('等级信息不得大于200位');
                if(Validate::checkNumber($_POST['level'])) Tool::alertBack('等级必须为数字');
                $this->model->level=$_POST['level'];
                if($this->model->getOneLevel()) Tool::alertBack('此等级编号已存在');
                $this->model->level_name=$_POST['level_name'];
                if($this->model->getOneLevel()) Tool::alertBack('此等级名称已存在');                
                $this->model->level_info=$_POST['level_info'];
                $this->model->premission=implode(',', ($_POST['premission']));
                $this->model->addLevel()?Tool::alertLocation('新增等级成功', 'level.inc.php?action=show') : Tool::alertBack('新增等级失败');
            }
            $premission=new PremissionModel();
            if($premission->getAllNoLimitPremission()){
                $this->tpl->assign('allPremission',$premission->getAllNoLimitPremission());
            }
            $this->tpl->assign('add',true);
            $this->tpl->assign('title','新增等级');
        }
        private function update(){
            if(isset($_GET['id'])){
                
                $this->model->id=$_GET['id'];
                if(is_object($this->model->getOneLevel())){
                    $this->tpl->assign('update_level_name',$this->model->getOneLevel()->level_name);
                    $this->tpl->assign('update_level',$this->model->getOneLevel()->level);
                    $this->tpl->assign('update_id',$this->model->getOneLevel()->id);
                    $this->tpl->assign('update_level_info',$this->model->getOneLevel()->level_info);
                    $preArray=explode(',', $this->model->getOneLevel()->premission);
                    $premission=new PremissionModel();
                    $object=$premission->getAllNoLimitPremission();
                    if($object){
                        foreach ($object as $value){
                            if(in_array($value->id, $preArray)){
                                $value->check='checked="checked"';
                            }
                        }
                        $this->tpl->assign('allPremission',$object);
                    }
                    
                }else{
                    Tool::alertBack('等级不存在');
                }
            
            }
            if(isset($_POST['id']) && isset($_POST['send'])){
                if(Validate::checkNull($_POST['level_name'])) Tool::alertBack('等级名称不得为空');
                if(Validate::checkLength($_POST['level_name'], 2, min)) Tool::alertBack('等级名称不得小于2位');
                if(Validate::checkLength($_POST['level_name'], 20, max)) Tool::alertBack('等级名称不得大于20位');
                if(Validate::checkLength($_POST['level_info'], 200, max)) Tool::alertBack('等级信息不得大于200位');
                if(Validate::checkNumber($_POST['level'])) Tool::alertBack('等级必须为数字');
                $this->model->level=$_POST['level'];
                //if($this->model->getOneLevel()) Tool::alertBack('此等级编号已存在');
                $this->model->level_name=$_POST['level_name'];
                $this->model->premission=implode(',', ($_POST['premission']));
               // if($this->model->getOneLevel()) Tool::alertBack('此等级名称已存在');
                $this->model->id=$_POST['id'];
                $this->model->level_info=$_POST['level_info'];
                $this->model->updateLevel()?Tool::alertLocation('修改等级成功', 'level.inc.php?action=show') : Tool::alertBack('修改等级失败');            
            }
            $this->tpl->assign('update',true);
            $this->tpl->assign('title','修改等级');
        }
        private function delete(){
            if(isset($_GET['id'])){
                $this->model->id=$_GET['id'];
                $this->model->deleteLevel()?Tool::alertLocation('删除等级成功', 'level.inc.php?action=show') : Tool::alertBack('删除等级失败');
            }
        }
    }
?>