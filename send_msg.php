<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/6/14
 * Time: 19:26
 * 发送消息
 */
require_once 'data.php';
require_once 'push.php';
if(isset($_POST['msg']) && isset($_POST['gate']) && isset($_POST['type'])) {
    //这个接口由网关调用，提交参数后使用推送将消息发给客户端
    // 由于编码原因无法发送中文， 现改为发送msg进行对应

    $msg = $_POST['msg'];
    $gate = $_POST['gate'];
    $type=$_POST['type'];

    if ($type == "1") {
        if ($msg == "01") {
            $msg = "一号结点温度异常";
        } else if ($msg == "02") {
            $msg = "二号结点温度异常";
        } else if ($msg == "03") {
            $msg = "三号结点温度异常";
        } else if ($msg == "04") {
            $msg = "四号结点温度异常";
        } else if ($msg == "05") {
            $msg = "五号结点温度异常";
        } else if ($msg == "06") {
            $msg = "六号结点温度异常";
        }

    } else if ($type == "2") {
        if ($msg == "01") {
            $msg = "一号结点红外异常";
        } else if ($msg == "02") {
            $msg = "二号结点红外异常";
        } else if ($msg == "03") {
            $msg = "三号结点红外异常";
        } else if ($msg == "04") {
            $msg = "四号结点红外异常";
        }

    } else if ($type == "3") {
        if ($msg == "01") {
            $msg = "一号结点烟雾异常";
        } else if ($msg == "02") {
            $msg = "二号结点烟雾异常";
        } else if ($msg == "03") {
            $msg = "三号结点烟雾异常";
        } else if ($msg == "04") {
            $msg = "四号结点烟雾异常";
        }

    }

    

    $pdo = connect();
    $sql = "INSERT INTO `msg`(`gate_imei`,`msg`,`type`) VALUES ('{$gate}', '{$msg}', '{$type}')";
    $pdo->beginTransaction();
    $stmt = $pdo->query($sql);
    $res = $stmt->rowCount();
    if ($res == 1) {
        $pdo->commit();
        // 标签固定 后期可拓展
        app_push('jlshix', $msg);
        echo success();
    } else {
        $pdo->rollBack();
        echo fail();
    }
}
else {
    echo no_para();
}