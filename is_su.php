<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 2016/7/20
 * Time: 22:48
 *
 * 用于判断是否为管理员
 * 参数: gate name
 * 描述: select master from gate where gate 然后是否为name
 * 返回: 成功返回 success() 失败返回相应错误码与描述 参见data.php
 */

require_once 'data.php';
if (isset($_POST['gate'])) {
    $gate = $_POST['gate'];
    $pdo = connect();
    $sql = "SELECT `master` FROM `gate` WHERE `imei`='{$gate}'";
    $stmt = $pdo->query($sql);
    $info = $stmt->fetchAll();
    $res = array(
        "code" => "1",
        "des" => "success",
        "info" => $info[0][0]
    );
    echo json_encode($res);
} else {
    echo no_para();
}