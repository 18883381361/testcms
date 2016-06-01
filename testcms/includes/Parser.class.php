<?php
//模版解析类
class Parser{
    private $tplcontent;//用来保存模版文件的内容
    //构造方法用来获取模版文件的内容
    public function __construct($tplfile){
        if(!$this->tplcontent=file_get_contents($tplfile)){
            exit('模版文件读取错误');
        }
    }
    //解析普通变量
    private function parVar(){
        $pattern='/\{\$(\w+)\}/';
        if(preg_match($pattern, $this->tplcontent)){
   
            $this->tplcontent=preg_replace($pattern, "<?php echo \$this->vars['\\1']?>", $this->tplcontent);
        }
    }
    
    //解析if语句
    private function parIf(){
        $patstartif='/\{if\s\$(\w+)\}/';
        $patendif='/\{\/if\}/';
        $patelse='/\{else\}/';
        if(preg_match($patstartif, $this->tplcontent)){       
            if(preg_match($patendif, $this->tplcontent)){
                $this->tplcontent=preg_replace($patstartif, "<?php if(\$this->vars['$1']){ ?>", $this->tplcontent);
                $this->tplcontent=preg_replace($patendif, "<?php } ?>", $this->tplcontent);
               if(preg_match($patelse, $this->tplcontent)){
                   $this->tplcontent=preg_replace($patelse, "<?php }else{ ?>", $this->tplcontent);
               }                
            }else{
                exit('没有结束标志');
            }
        }
    }
    //解析注释
    private function parCommon(){
        $pattern='/\{#\}(.*)\{#\}/';
        if(preg_match($pattern, $this->tplcontent)){
            $this->tplcontent=preg_replace($pattern, "<?php /*$1*/ ?>", $this->tplcontent);
        }
    }
    //解析foreach语句
    private function parForeach(){
        $patstartfor='/\{foreach\s+\$(\w+)\((\w+),(\w+)\)\}/';
        $patendfor='/\{\/foreach\}/';
        $patcontent='/\{\@(\w+)([\w\-\>\+]*)\}/';
        if(preg_match($patstartfor, $this->tplcontent)){
            if(preg_match($patendfor, $this->tplcontent)){
                $this->tplcontent=preg_replace($patstartfor, "<?php foreach(\$this->vars['$1'] as \$$2=>\$$3){ ?>", $this->tplcontent);
                $this->tplcontent=preg_replace($patendfor, "<?php } ?>", $this->tplcontent);
                if(preg_match($patcontent, $this->tplcontent)){
                   $this->tplcontent=preg_replace($patcontent, "<?php echo \$$1$2 ?>", $this->tplcontent);
                }
            }else{
                exit('缺少结束标签');
            }
        }
    }
	//解析for语句，用于内嵌循环
	private function parFor() {
		$_pattenFor = '/\{for\s+\@([\w\-\>]+)\(([\w]+),([\w]+)\)\}/';
		$_pattenEndFor = '/\{\/for\}/';
		$_pattenVar = '/\{@([\w]+)([\w\-\>\+]*)\}/';
		if (preg_match($_pattenFor,$this->tplcontent)) {
			if (preg_match($_pattenEndFor,$this->tplcontent)) {
				$this->tplcontent = preg_replace($_pattenFor,"<?php foreach (\$$1 as \$$2=>\$$3) { ?>",$this->tplcontent);
				$this->tplcontent = preg_replace($_pattenEndFor,"<?php } ?>",$this->tplcontent);
				if (preg_match($_pattenVar,$this->tplcontent)) {
					$this->tplcontent = preg_replace($_pattenVar,"<?php echo \$$1$2?>",$this->tplcontent);
				}
			} else {
				exit('ERROR：for语句必须有结尾标签！');
			}
		}
	}
    //解析include语句
    private function parInclude(){
        $pattern='/\{include\s+file=(\"|\')([\w\.\_\/]+)(\"|\')\}/';
        if(preg_match_all($pattern, $this->tplcontent,$file)){
            foreach ($file[2] as $file_name){
                if(!file_exists('templates/'.$file_name)){
                    echo "文件不存在";
                }
                $this->tplcontent=preg_replace($pattern,"<?php \$tpl->create('$2') ?>", $this->tplcontent);
            }
        }
    }
    //解析系统变量
    private function configVar(){
        $pattern='/<!--\{(\w+)\}-->/';
        if(preg_match($pattern, $this->tplcontent)){
            $this->tplcontent=preg_replace($pattern, "<?php echo \$this->config['$1'] ?>", $this->tplcontent);
        }
    }
    //用来解析
    public function compile($parfile){
        $this->parVar();
        $this->parIf();
        $this->parCommon();        
        $this->parForeach(); 
        $this->parFor();
        $this->parInclude();
        $this->configVar();
        if(!file_put_contents($parfile,$this->tplcontent)){
            exit('编译文件生成失败');
        }
    }
}