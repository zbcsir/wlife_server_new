<?php
require_once 'push.php';
require_once 'data.php';
if (isset($_POST['tag']) && isset($_POST['msg'])) {
    $res =  gate_push($_POST['tag'], $_POST['msg']);
    if (strlen($res) > 10) {
        echo success();
    } else {
        echo fail();
    }
} else {
    echo no_para();
}