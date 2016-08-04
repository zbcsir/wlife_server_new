<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 2016/7/20
 * Time: 22:48
 *
 * 用于添加家庭成员 实际上就是变相的绑定网关 所以参考bind_gate.php
 * 参数: gate name
 * 描述: update account set gate where name
 * 返回: 成功返回 success() 失败返回相应错误码与描述 参见data.php
 */

require_once 'data.php';
if(isset($_POST['gate']) && isset($_POST['name'])){
    $gate=$_POST['gate'];
    $name=$_POST['name'];

    $pdo=connect();
    $sql1="UPDATE `account` SET `gate_imei`='{$gate}' WHERE `name`='{$name}'";

    $pdo->beginTransaction();
    $stmt = $pdo->query($sql1);
    $res1 = $stmt->rowCount();

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