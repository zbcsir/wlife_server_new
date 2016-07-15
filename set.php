<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/6/16
 * Time: 15:16
 * 发送节点信息
 */

require_once 'data.php';
if(isset($_POST['gate']) && isset($_POST['type']) && isset($_POST['no']) && isset($_POST['state'])) {
    //这个接口由网关调用，提交参数后将节点信息发给客户端
    $gate = $_POST['gate'];
    $type = $_POST['type'];
    $no = $_POST['no'];
    $state=$_POST['state'];
    $pdo = connect();
    $sql = "UPDATE `device` SET `state`= '{$state}' WHERE `gate`= '{$gate}' AND `type`='{$type}' AND `no`='{$no}'";
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