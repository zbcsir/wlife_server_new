<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/6/16
 * Time: 15:15
 * 获取节点信息
 */
require_once 'data.php';
if(isset($_POST['gate'])&&isset($_POST['type'])) {
    $gate= $_POST['gate'];
    $type = $_POST['type'];
    $pdo = connect();
    if ($type == "00") {
        $sql = "SELECT `type`,`no`,`sign`,`place`,`name`,`state` FROM `device` WHERE `gate`='{$gate}' AND (`type`='04' OR `type`='05' OR `type`='06') ORDER BY `dev_imei`";
    } else {
        $sql = "SELECT `no`,`sign`,`place`,`name`,`state` FROM `device` WHERE `gate`='{$gate}' AND `type`='{$type}'ORDER BY `dev_imei`";
    }

    $stmt = $pdo->query($sql);
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $dev = $res;
    $res = array(
        "code" => "1",
        "info" => $dev,
        "des"=>"success"
    );
    echo json_encode($res);
}
else {
    echo no_para();
}