<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 2016/7/20
 * Time: 22:48
 *
 * 用于删除家庭成员 实际上就是变相的解绑网关 所以参考unbind_gate.php
 * 参数: gate name
 * 描述: update account set gate = null where name
 * 返回: 成功返回 success() 失败返回相应错误码与描述 参见data.php
 */
require_once 'data.php';
if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $pdo = connect();
    $sql = "UPDATE `account` SET `gate_imei`=NULL WHERE `name`='{$name}'";
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
} else {
    echo no_para();
}