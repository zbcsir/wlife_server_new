<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/6/14
 * Time: 19:07
 * 绑定网关 TODO 更新 需code对比 然后时间
 */
require_once 'data.php';
if(isset($_POST['mail']) && isset($_POST['gate']) && isset($_POST['name'])){
    $mail=$_POST['mail'];
    $gate=$_POST['gate'];
    $name=$_POST['name'];
    $pdo=connect();
    $sql1="UPDATE `account` SET `gate_imei`='{$gate}' WHERE `mail`='{$mail}'";
    $sql2="UPDATE `gate` SET `name`='{$name}' WHERE `imei`='{$gate}'" ;
    $pdo->beginTransaction();
    $stmt1 = $pdo->query($sql1);
    $stmt2 = $pdo->query($sql2);
    $res1 = $stmt1->rowCount();
    $res2 = $stmt2->rowCount();
    // 数据库中网关可存在
    if ($res1 == 1 && $res2 == 1) {
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