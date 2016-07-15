<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 *注册账号
 * Date: 2016/6/14
 * Time: 18:07
 */

require_once 'data.php';
error_reporting(E_ALL^E_NOTICE);
if(isset($_POST['mail']) && isset($_POST['name']) && isset($_POST['pw'])) {
    //密码是否一致在客户端完成检测
    $pdo = connect();
    $mail = $_POST['mail'];
    $name = $_POST['name'];
    $pw = sha1($_POST['pw']);

    $sql = "INSERT INTO `account`(`mail`, `name`, `pw`)
                      VALUES('{$mail}', '{$name}', '{$pw}')";
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
}
else {
    echo no_para();
}