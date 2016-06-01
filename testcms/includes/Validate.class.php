<?php 
    //验证类
    class Validate{
        
        //是否为空
        static public function checkNull($data){
            if(trim($data)=="") return ture;
            return false;
            
            
        }
        //电子邮件格式是否合法
        static function checkEmail($data){
            $patter='/^(\w+)@([\w\.]+)$/';
            if(preg_match($patter,$data)) return false;
            return true;
        }
        //长度是否合法
        static public function checkLength($data,$length,$flags){
            if($flags=='min'){
                if(mb_strlen(trim($data))<$length){
                    return true;
                }
            }elseif($flags=='max'){
                if( mb_strlen(trim($data))>$length){
                    return true;
                }
            }elseif($flags=='equal'){
                if(mb_strlen(trim($data))!=$length){
                    return true;
                }
            }else{
                Tool::alertBack('传的参数有误');
            } 
            return false;               
        }
        
        //数据是否一致
        static public function checkEquals($data1,$data2){
            if(trim($data1)!=trim($data2)) return true;
            return false;
        }
        
        //是否位数字
        static public function checkNumber($data){
            if(!is_numeric(trim($data))) return true;
            return false;
        }
        
        //验证码是否和session里面的一致
        static public function checkSessionCode($code){
            if(strtolower($code)!=$_SESSION['code']) return true;
            return false;
        }
        
        //验证session是否存在
        static public function is_session(){
            if(!isset($_SESSION['admin'])){
                Tool::alertLocation(null, 'admin_login.php');
            }
        }
        //验证权限
        static public function checkPremission($premission,$info){
           if(!in_array($premission, $_SESSION['admin']['premission'])) Tool::alertBack($info);
        }
    }
?>