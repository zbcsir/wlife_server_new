<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/6/14
 * Time: 19:26
 * 用户反馈
 */
require_once 'data.php';
if(isset($_POST['mail']) && isset($_POST['contact']) && isset($_POST['msg'])){
    //获取反馈，需要判断 number和content的空值
    $pdo = connect();
    $mail = $_POST['mail'];
    $contact = $_POST['contact'];
    $msg= $_POST['msg'];
    $sql = "INSERT INTO `feedback`(`mail`, `contact`, `msg`)
                      VALUES('{$mail}', '{$contact}', '{$msg}')";
    $pdo->beginTransaction();
    $stmt = $pdo->query($sql);
    if ($stmt->rowCount() == 1) {
        $pdo->commit();
        echo success();
    } else {
        $pdo->rollBack();
        echo fail();
    }
}
else {
    echo no_para();
}