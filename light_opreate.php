<?php
/**
 * Created by PhpStorm.
 * User: zbc
 * Date: 2016/8/18
 * Time: 20:18
 */

class PWMOperate
{

    private function connect(){
        $dsn = 'mysql:dbname=zigsys;host=jlshix.com';
        $user = 'root';
        $password = 'aili4718';

        try {
            $pdo = new PDO($dsn, $user, $password);
            header('Content-Type: text/html; charset=UTF-8');
            $pdo->query("SET NAMES 'UTF8'");
            return $pdo;
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
            return null;
        }
    }
    //获得节点号
    public function getNodeid($gate,$place){
        $con = $this->connect() ;
        $sql = "SELECT `no` FROM `device` WHERE `gate`='{$gate}' AND `type`='09' AND `place`=$place" ;
        $con = $this->connect() ;
        $stmt = $con->query($sql) ;
        if($stmt->rowCount() == 1){
            $res = $stmt->fetch() ;
            return $res[0] ;
        } else{
            return null ;
        }
    }
    //获得亮度
    public function getLight($gate,$nodeid){
        $pdo = $this->connect() ;
        $sql = "SELECT SUBSTRING(state,4,1) FROM `device` WHERE `gate`='{$gate}' 
AND `no`='{$nodeid}' AND `type`='09'" ;
        $stmt = $pdo->query($sql) ;
        if($stmt->rowCount() == 1) {
            $res = $stmt->fetch() ;
            return (int)$res[0] ;
        } else{
            return null ;
        }
    }

    //修改亮度
    public function updateLight($gate,$nodeid,$light){
        if($light >= 0 && $light <= 9){
            $state = '000'.$light ;
            $sql = "UPDATE `device` SET `state`='{$state}' WHERE `gate`='{$gate}' AND `no`='{$nodeid}' AND type='09'" ;
            $con = $this->connect() ;
            $stmt = $con->query($sql) ;
            if($stmt->rowCount() == 1){
//            $con->con_new()->commit() ;
                return true ;
            }else{
//            $con->con_new()->rollBack() ;
                return false ;
            }
        }else{
            return false ;
        }
    }

    //灯光调亮
    public function lighter($imei,$place){
        $order = "09" ;
        $nodeid = $this->getNodeid($imei,$place) ;
        $order = $order.$nodeid.'00' ;
        $light = $this->getLight($imei,$nodeid) ;
        if($light < 8){
            $light = $light + 2 ;
            $order = $order.'0'.$light ;
            return $order ;
        }else{
            return null ;
        }

    }

    //灯光调暗
    public function darker($imei,$place){
        $order = "09" ;
        $nodeid = $this->getNodeid($imei,$place) ;
        $order = $order.$nodeid.'00' ;
        $light = $this->getLight($imei,$nodeid) ;
        if($light > 1){
            $light = $light - 2 ;
            $order = $order.'0'.$light ;
            return $order ;
        }else{
            return null ;
        }

    }
}