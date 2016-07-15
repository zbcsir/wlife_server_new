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
    && isset($_POST['type']) && isset($_POST['name']) &&isset($_POST['state'])){
    $gate=$_POST['gate'];
    $dev=$_POST['dev'];
    $no=$_POST['no'];
    $type = $_POST['type'];
    $name=$_POST['name'];
    $state = $_POST['state'];
    $pdo=connect();
    $sql= "INSERT INTO `device`(`gate`,`dev_imei`,`no`, `type`,`name`, `state`)
                      VALUES('{$gate}', '{$dev}', '{$no}', '{$type}','{$name}', '{$state}')";
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
}