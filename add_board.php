<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 2016/7/20
 * Time: 22:48
 * zbc here 17：56
 * 用于家庭留言板
 * 参数: gate name content
 * 描述: insert into board
 * 返回: 成功返回 success() 失败返回相应错误码与描述 参见data.php
 */
require_once 'data.php';
if (isset($_POST['gate']) && isset($_POST['name']) && isset($_POST['content']) ) {
    $gate = $_POST['gate'];
    $name = $_POST['name'];
    $content = $_POST['content'];

    $pdo = connect();
    $sql = "INSERT INTO `board`(`gate`, `name`, `content`)
                  VALUES ('{$gate}', '{$name}', '{$content}')";
    $pdo->beginTransaction();
    $stmt = $pdo->query($sql);
    $row = $stmt->rowCount();
    if ($row == 1) {
        $pdo->commit();
        echo success();
    } else {
        $pdo->rollBack();
        echo fail();
    }
} else {
    echo no_para();
}