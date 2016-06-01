<?php
//模板类
class Templates{
    private $vars=array();
    private $config=array();
    private $nocacheArray=array();
    public function __construct($nocache){
        if(!is_dir(TPL_DIR) || !is_dir(TPL_C_DIR) || !is_dir(CACHE)){
            exit('模版目录不存在或编译文件目录不存在或缓存目录不存在');  
        }
        if(file_exists(ROOT_PATH.'config/profile.xml')){
            $sxe=simplexml_load_file(ROOT_PATH.'config/profile.xml');
            $taglib=$sxe->xpath('/root/taglib');
            foreach ($taglib as $tag){
                $this->config["$tag->name"]=$tag->value;
            }
        }else{
            exit('文件不存在');
        }
        $this->nocacheArray=$nocache;
    }
    //创建变量注入方法
    public function assign($vars,$value){
        if(isset($vars) && !empty($vars)){
            $this->vars[$vars]=$value;
        }else{
            exit('请设置变量名');          
        }
    }
    //cache()方法 ,直接加载缓存文件
    public function cache($file){
        //设置模版文件的路径
        $tplfile=TPL_DIR.$file;
        //判断模版文件是否存在
        if(!file_exists($tplfile)){
            exit('模版文件不存在');
        }
        //获取文件名后面的参数
        if(!empty($_SERVER['QUERY_STRING'])){
            $file .=$file.$_SERVER['QUERY_STRING'];
        }
        //设置编译文件的文件名
        $parfile=TPL_C_DIR.md5($tplfile).$file.'.php';
        //设置缓存文件的文件名
        $cachefile=CACHE.md5($tplfile).$file.'.html';
        //判断缓冲文件是否存在，模版文件和编译文件是否被修改过
        if(IS_CACHE){
            if(file_exists($parfile) && file_exists($cachefile)){
                if(filemtime($parfile)>=filemtime($tplfile) && filemtime($cachefile)>=filemtime($parfile)){
                    //echo "执行的是缓冲文件";
                    include $cachefile;
                    exit();
                }
            }
        }
    }
    //display()方法
    public function display($file){
        //给include进来的tpl传递一个模版对象
        $tpl=$this;
        
        //设置模版文件的路径
        $tplfile=TPL_DIR.$file;
        //判断模版文件是否存在
        if(!file_exists($tplfile)){
            exit('模版文件不存在');
        }
        //设置编译文件的文件名
        $parfile=TPL_C_DIR.md5($tplfile).$file.'.php';
        //获取文件名后面的参数
        if(!empty($_SERVER['QUERY_STRING'])){
            $file .=$file.$_SERVER['QUERY_STRING'];
        }
        
        //设置缓存文件的文件名
        $cachefile=CACHE.md5($tplfile).$file.'.html';
        
        //判断编译文件是否存在，模版文件是否被修改过
        if(!file_exists($parfile) || filemtime($parfile)<filemtime($tplfile)){
            //引入模版解析类
            require_once ROOT_PATH.'includes/Parser.class.php';
            $par=new Parser($tplfile);
            $par->compile($parfile);
            
        }
        //引入编译文件
        include $parfile;
        if(IS_CACHE && !in_array(Tool::toTpl(), $this->nocacheArray)){
            file_put_contents($cachefile, ob_get_contents());
            ob_end_clean();
            include $cachefile;
        }
    }
    //create()方法用来给被别人调用的模版解析，不用生成缓存文件
    public function create($file){
        $tplfile=TPL_DIR.$file;
        //判断模版文件是否存在
        if(!file_exists($tplfile)){
            exit('模版文件不存在');
        }
        //设置编译文件的文件名
        $parfile=TPL_C_DIR.md5($tplfile).$file.'.php';
        //设置缓存文件的文件名
        $cachefile=CACHE.md5($tplfile).$file.'.html';
        //判断编译文件是否存在，模版文件是否被修改过
        if(!file_exists($parfile) || filemtime($parfile)<filemtime($tplfile)){
            //引入模版解析类
            require_once ROOT_PATH.'includes/Parser.class.php';
            $par=new Parser($tplfile);
            $par->compile($parfile);
        
        }
        //引入编译文件
        include $parfile;
    }
}