<?php 
    class DB{
        //连接数据库函数
        static function getDB(){
            $mysqli=new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME);
            //判断数据库是否连接正确
            if(mysqli_connect_errno()){
                echo "数据库连接错误,错误代码:".mysqli_connect_error();
            }
            return $mysqli;
        }
        //清理结果集和对象
        static function unDB(&$result,&$db){
          
            if(is_object($result)){
                //清理结果集
                $result->free();
                //销毁结果集对象
                $result=null;
            }
            if(is_object($db)){
                //关闭数据库
                $db->close();
                //销毁对象句柄
                $db=null;
            }
        }
        
    }
?>