<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/6/14
 * Time: 19:24
 * 解除绑定
 */
require_once 'data.php';

if(isset($_POST['mail'])){
    $mail=$_POST['mail'];
    $pdo=connect();
    $sql="UPDATE `account` SET `gate_imei`=NULL WHERE `mail`='{$mail}'";
    $pdo->beginTransaction();
    $stmt = $pdo->query($sql);
    $res = $stmt->rowCount();
    if ($res == 1) {
        $pdo->commit();
        echo success();
    } else {
        $pdo->rollBack();
        echo fail();
    }
}else{
    echo no_para();
}
