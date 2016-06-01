<?php 
    //控制器类
    class ContentAction extends Action{
        public function __construct(&$tpl){
            parent::__construct($tpl, new ContentModel());
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
            if(!empty($_GET['nav'])){
                $this->model->nav=$_GET['nav'];
                if($this->model->getChildTotalList()!=0){
                    parent::page($this->model->getChildTotalList());
                }
                $object=$this->model->getAllList();
            }else{
                if($this->model->getAllTotalList()!=0){
                    parent::page($this->model->getAllTotalList());
                }
                $object=$this->model->getAllListContent();
            }
            Tool::subStr($object, title, 10, 'utf-8');
            $this->getNav();
            $this->tpl->assign('show',true);
            $this->tpl->assign('title','文档列表');
            $this->tpl->assign('alllist',$object);
            
        }
        private function add(){
            if(isset($_POST['send'])){
                //$this->getPost();
                echo $_POST['content'];
//                 if($this->model->addContent()){
//                     Tool::alertLocation('新增文档成功', '?action=show');
//                 }else{
//                     Tool::alertBack('新增文档失败');
//                 }
            }
            $this->tpl->assign('add',true);
            $this->tpl->assign('title','新增文档');
            $this->getNav();
            $this->tpl->assign('author',$_SESSION['admin']['admin_name']);
        }
        private function update(){
            if(isset($_POST['send'])){
                $this->getPost();
                $this->model->id=$_POST['id'];
                if($this->model->UpdateContent()){
                    Tool::alertLocation('修改文档成功', $_POST['prev_url']);
                }else{
                    Tool::alertBack('修改文档失败');
                }
            }
            $this->tpl->assign('update',true);
            $this->tpl->assign('title','修改文档');
            if(isset($_GET['id'])){
                $this->model->id=$_GET['id'];
                $list=$this->model->getOneList();
                $this->tpl->assign('listtitle',$list->title);
                $this->tpl->assign('tag',$list->tag);
                $this->tpl->assign('keyword',$list->keyword);
                $this->tpl->assign('thumb',$list->thumb);
                $this->tpl->assign('source',$list->source);
                $this->tpl->assign('author',$list->author);
                $this->tpl->assign('info',$list->info);
                $this->tpl->assign('content',$list->content);
                $this->tpl->assign('count',$list->count);
                $this->tpl->assign('gold',$list->gold);
                $this->tpl->assign('id',$list->id);
                $this->tpl->assign('prev_url',PREV_URL);
                $this->getNav($list->nav);
                $this->attr($list->attr);
                $this->color($list->color);
                $this->sort($list->sort);
                $this->readlimit($list->readlimit);
                $this->commend($list->commend);
            }else{
                Tool::alertBack('该文档不存在');
            }
           
        }
        private function delete(){
            if(isset($_GET['id'])){
                $this->model->id=$_GET['id'];
                if($this->model->deleteContent()){
                    Tool::alertLocation('文档删除成功', '?action=show');
                }else{
                    Tool::alertBack('文档删除失败');
                }
            }else{
                Tool::alertBack('该文档不存在');
            }
        }
        
        //getPost
        private function getPost(){
            if(Validate::checkNull($_POST['title'])) Tool::alertBack('标题不能为空');
            if(Validate::checkLength($_POST['title'], 2, min)) Tool::alertBack('标题不能小于2位');
            if(Validate::checkLength($_POST['title'], 50, max)) Tool::alertBack('标题不能大于50位');
            if(Validate::checkNull($_POST['nav'])) Tool::alertBack('必须选择一个栏目');
            if(Validate::checkLength($_POST['tag'], 30, max)) Tool::alertBack('标签不能大于30位');
            if(Validate::checkLength($_POST['keyword'], 30, max)) Tool::alertBack('关键字不能大于30位');
            if(Validate::checkLength($_POST['source'], 20, max)) Tool::alertBack('文章来源不能大于20位');
            if(Validate::checkLength($_POST['author'], 10, max)) Tool::alertBack('作者不能大于10位');
            if(Validate::checkLength($_POST['info'], 200, max)) Tool::alertBack('内容摘要不能大于200位');
            if(Validate::checkNull($_POST['content'])) Tool::alertBack('详细内容不能为空');
            if(Validate::checkNumber($_POST['count'])) Tool::alertBack('浏览次数必须是数字');
            if(Validate::checkNumber($_POST['gold'])) Tool::alertBack('消费金币必须是数字');
            $this->model->title=$_POST['title'];
            if(isset($_POST['attr'])){
                $this->model->attr=implode(',', $_POST['attr']);
            }else{
                $this->model->attr='无属性';
            }
            $this->model->nav=$_POST['nav'];
            $this->model->tag=$_POST['tag'];
            $this->model->keyword=$_POST['keyword'];
            $this->model->thumb=$_POST['thumb'];
            $this->model->source=$_POST['source'];
            $this->model->author=$_POST['author'];
            $this->model->info=$_POST['info'];
            $this->model->content=$_POST['content'];
            $this->model->commend=$_POST['commend'];
            $this->model->count=$_POST['count'];
            $this->model->gold=$_POST['gold'];
            $this->model->color=$_POST['color'];
            $this->model->sort=$_POST['sort'];
            $this->model->readlimit=$_POST['readlimit'];
        }
        //nav
        private function getNav($select=0){
            $nav=new NavModel();
            foreach ($nav->getAllNoLimitNav() as $object){
                $html.='<optgroup label="'.$object->nav_name.'">';
                $nav->id=$object->id;
                if(!!$child=$nav->getChildAllNoLimitNav()){
                    foreach ($child as $childobject){
                        if($childobject->id==$select){
                            $html.='<option value="'.$childobject->id.'" selected="selected">'.$childobject->nav_name.'</option>';
                        }
                        $html.='<option value="'.$childobject->id.'">'.$childobject->nav_name.'</option>';
                    }
                }
                $html.='</optgroup>';
            }
            $this->tpl->assign('nav_name',$html);
        }
        
        private function attr($listattr){          
            $attrarray=explode(',',$listattr);          
            $attrArray=array('头条','推荐','加粗','跳转');
            $attrNo=array_diff($attrArray, $attrarray);
            if($attrarray['0']!='无属性'){
                foreach ($attrarray as $attr){
                            $html.='<input type="checkbox" name="attr[]" value="'.$attr.'" checked="checked"/>'.$attr;
                }
            }
            foreach ($attrNo as $attr){
                $html.='<input type="checkbox" name="attr[]" value="'.$attr.'"/>'.$attr;
            }
            $this->tpl->assign('attr',$html);
        }
        
        private function color($color){
            $colorarray=array(''=>'默认颜色','red'=>'红色','blue'=>'蓝色','orange'=>'橙色');
            foreach ($colorarray as $key=>$value){
                if($key==$color){
                    $html.='<option value="'.$key.'" style="color:'.$key.';" selected="selected">'.$value.'</option>';
                }else{
                    $html.='<option value="'.$key.'" style="color:'.$key.';">'.$value.'</option>';
                }
            }
            $this->tpl->assign('color',$html);
        }
        
        private function sort($sort){
            $sortarray=array('0'=>'默认排序','1'=>'置顶一天','2'=>'置顶一周','3'=>'置顶一月','4'=>'置顶一年');
            foreach ($sortarray as $key=>$value){
                if($key==$sort){
                    $html.='<option value="'.$key.'" style="color:'.$key.';" selected="selected">'.$value.'</option>';
                }else{
                    $html.='<option value="'.$key.'" style="color:'.$key.';">'.$value.'</option>';
                }
            }
            $this->tpl->assign('sort',$html);            
        }
        
        private function readlimit($readlimit){
            $limitarray=array('0'=>'开发浏览','1'=>'初级会员','2'=>'中级会员','3'=>'高级会员','4'=>'VIP会员');
            foreach ($limitarray as $key=>$value){
                if($key==$readlimit){
                    $html.='<option value="'.$key.'" style="color:'.$key.';" selected="selected">'.$value.'</option>';
                }else{
                    $html.='<option value="'.$key.'" style="color:'.$key.';">'.$value.'</option>';
                }
            }
            $this->tpl->assign('readlimit',$html);
        }
        
        private function commend($commend){
            $commendarray=array('0'=>'禁止评论','1'=>'允许评论');
            foreach ($commendarray as $key=>$value){
                if($key!=$commend){
                    $html.='<input type="radio" name="commend" value="'.$key.'"/>'.$value;  
                }else{
                    $html.='<input type="radio" name="commend" value="'.$key.'" checked="checked"/>'.$value;
                }
            }
            $this->tpl->assign('commend',$html);
        }
    }
?>