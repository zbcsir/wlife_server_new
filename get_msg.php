<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/6/14
 * Time: 19:25
 * 获取消息列表
 */

require_once 'data.php';
if(isset($_POST['gate'])&&isset($_POST['type'])) {
    //账号->设备imei->消息
    $gate= $_POST['gate'];
    $type=$_POST['type'];
    $pdo = connect();
    if ($type==0){
        $sql = "SELECT `dt`,`msg` FROM `msg` WHERE `gate_imei`='{$gate}' ORDER BY `dt` DESC " ;
    }else{
        $sql = "SELECT `dt`,`msg` FROM `msg` WHERE `gate_imei`='{$gate}' and `type`='{$type}'  ORDER BY `dt` DESC ";
    }
    $stmt = $pdo->query($sql);
    $dev = $stmt->fetchAll(PDO::FETCH_ASSOC);
//    print_r($dev);
    //$dev = $res[0][0];

    //$sql = "SELECT * FROM `msg` WHERE `gate_imei`= '{$dev}' ORDER BY `id` DESC ";
    //$stmt = $pdo->query($sql);
    //$msg = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $res = array(
        "code" => "1",
        "info" => $dev
    );
    echo json_encode($res);
} else {
    echo no_para();
}