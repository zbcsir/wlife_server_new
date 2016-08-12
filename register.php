<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 *注册账号
 * Date: 2016/6/14
 * Time: 18:07
 */

require_once 'data.php';
include_once('Easemob.class.php');
$options['client_id']="YXA6jhnjUPTZEeW5mTkx4owsGg";
$options['client_secret']="YXA6e1xOW6_1R3ws9nEYAIITtiZXwqk";
$options['org_name']="wlife";
$options['app_name']="wlife";
$easemob=new Easemob($options);
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
        $account['username']=$mail ;
        $account['password']=$_POST['pw'];
        //这里处理自己服务器注册的流程
        //自己服务器注册成功后向环信服务器注册
        $result=$easemob->accreditRegister($account);
        $reg = json_decode($result, true);
//        echo $result;
        // TODO 检错 rowCount
        if ($reg['status'] == 200) {
            $pdo->commit();
            echo success();
        } else {
            $pdo->rollBack();
            echo fail();
        }
    } else {
        $pdo->rollBack();
        echo fail();
    }
}
else {
    echo no_para();
}