<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 2016/7/20
 * Time: 22:48
 *
 * 用于获取家庭留言板消息
 * 参数: gate
 * 描述: 先不对条数进行限制
 * 返回: 成功返回 {code des info} code状态码 des描述 info为内容 直接ba查询结果转为json放入此字段即可
 *      失败返回相应错误码与描述 参见data.php
 */
require_once 'data.php';
if (isset($_POST['gate'])) {
    $gate = $_POST['gate'];
    $pdo =connect();
    $sql = "SELECT * FROM `board` WHERE `gate`='{$gate}'";
    $stmt = $pdo->query($sql);
    $info = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $res = array(
        "code" => "1",
        "des" => "success",
        "info" => $info
    );

    echo json_encode($res);

} else {
    echo no_para();
}