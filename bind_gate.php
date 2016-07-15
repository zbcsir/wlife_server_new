<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/6/14
 * Time: 19:07
 * 绑定网关
 */
require_once 'data.php';
if(isset($_POST['mail']) && isset($_POST['gate']) && isset($_POST['name'])){
    $mail=$_POST['mail'];
    $gate=$_POST['gate'];
    $name=$_POST['name'];
    $pdo=connect();
//    $sql="INSERT INTO `gate`(`imei`,`name`) VALUES('{$gate}','{$name}')";
    $sql1="UPDATE `account` SET `gate_imei`='{$gate}' WHERE `mail`='{$mail}'";
    $pdo->beginTransaction();
//    $stmt = $pdo->query($sql);
//    $res = $stmt->rowCount();
    $stmt = $pdo->query($sql1);
    $res1 = $stmt->rowCount();
    // 数据库中网关可存在
    if ($res1 == 1) {
        $pdo->commit();
        echo success();
        }
    else {
        $pdo->rollBack();
        echo fail();
    }

}else{
    echo no_para();
}