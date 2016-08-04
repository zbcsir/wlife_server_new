<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/6/14
 * Time: 18:12
 * 账号登录
 */
require_once 'data.php';
error_reporting(E_ALL^E_NOTICE);
if(isset($_POST['mail']) && isset($_POST['pw'])){
    $pdo = connect();
    $mail = $_POST['mail'];
    $pw = sha1($_POST['pw']);
    $sql = "SELECT `account`.`name`, `mail`, `pw`, `gate_imei`, `layout`, `master`
              FROM `account` LEFT JOIN `gate` ON `gate_imei`=`gate`.`imei`
              WHERE `mail`='{$mail}'";
    $stmt = $pdo->query($sql);
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $rpw = $res[0]['pw'];
    if (empty($res)) {
        echo no_mail();
        return;
    }
    if ($pw == $rpw) {
        $content = get_account($pdo, $mail);
        $res = array(
            "code" => "1",
            "info" => $res[0]
        );
        echo json_encode($res);
    } else {
        echo wrong_pw();
    }
}
else {
    echo no_para();
}