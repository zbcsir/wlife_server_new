<?php
require_once 'push.php';
require_once 'data.php';
if (isset($_POST['tag']) && isset($_POST['msg']) && isset($_POST['type'])) {
    $tag = $_POST['tag'];
    $msg = $_POST['msg'];
    $type = intval($_POST['type']);
    $res = 'res';

    if ($type == 1) {
        // type = 1 时为通知
        $res = app_push($tag, $msg);
    } elseif ($type == 2) {
        // type = 2 时为自定义消息
        $res = app_msg($tag, $msg);
    }
    
    if (strlen($res) > 10) {
        echo success();
    } else {
        echo fail();
    }
} else {
    echo no_para();
}