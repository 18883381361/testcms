<?php 
    //模型基类
    class Model{
        //查找单个数据模型
        protected function one($sql){
            $db=DB::getDB();
            $result=$db->query($sql);
            $object=new stdClass();
            //必须用这种形式，面向对象的,不能用mysqli_fetch_object这种面向过程的
            $object=$result->fetch_object();
            DB::unDB($result, $db);
            return Tool::htmlString($object);
        }
        //获取数据总条数模型
        protected function total($sql){
            $db=DB::getDB();
            $result=$db->query($sql);
            $total=$result->num_rows;
            DB::unDB($result, $db);
            return $total;
        }
        
        //查找多个数据模型
        protected function all($sql){
            $db=DB::getDB();
            $result=$db->query($sql);
            $html=array();
            $objects=new stdClass();
            while(!!$objects=$result->fetch_object()){
                $html[]=$objects;
            }
            DB::unDB($result, $db);
            return Tool::htmlString($html);
        }
        
        //增删改模型
        protected function asu($sql){
            $db=DB::getDB();
            $db->query($sql);
            $affected_rows=$db->affected_rows;              
            DB::unDB($result=null, $db);
            return $affected_rows;
        }
        
        //获取数据库表的信息
        protected function nextid($table){
            $sql="show table status like '$table'";
            $object=$this->one($sql);
            return $object->Auto_increment;
        }
        
        //多条sql语句
        protected function multi($sql){
            $db=DB::getDB();
            $db->multi_query($sql);
            DB::unDB($result=null, $db);
            return true;
        }
    }
?>