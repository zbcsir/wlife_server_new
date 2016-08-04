<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/6/14
 * Time: 19:25
 * 添加设备
 */
require_once 'data.php';
//require_once 'Easemob.class.php';
//添加设备到device表
// http://jlshix.com/zigsys/add_dev.php?gate=4718&dev=66162&no=01&type=0B&name=test&state=----
if(isset($_POST['gate']) && isset($_POST['dev']) && isset($_POST['no'])
    && isset($_POST['type']) && isset($_POST['sign']) && isset($_POST['place'])
    && isset($_POST['name']) && isset($_POST['state'])){
    $gate=$_POST['gate'];
    $dev=$_POST['dev'];
    $no=$_POST['no'];
    $type = $_POST['type'];
    $sign = $_POST['sign'];
    $place = $_POST['place'];
    $name=$_POST['name'];
    $state = $_POST['state'];
    $pdo=connect();
    $sql= "INSERT INTO `device`(`gate`,`dev_imei`,`no`, `type`,`sign`, `place`,`name`, `state`)
                      VALUES('{$gate}', '{$dev}', '{$no}', '{$type}', '{$sign}', '{$place}','{$name}', '{$state}')";
    $pdo->beginTransaction() ;//启动事务处理
    $stat = $pdo->query($sql) ;
    $count = $stat->rowCount() ;

    if ($count == 1) {
        $pdo->commit();
        echo success();
    } else {
        $pdo->rollBack();
        echo fail();
    }
}else{
    echo no_para();
//    echo json_encode($_POST);
    $res = array(
        "code" => "0",
        "info" => $_POST
    );
    echo json_encode($res);
}