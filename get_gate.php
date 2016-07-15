<?php

require_once 'data.php';
if (isset($_POST['mail'])) {
    $mail = $_POST['mail'];
    $pdo = connect();
    $sql = "SELECT * FROM `gate` WHERE `imei` = (SELECT `gate_imei` FROM `account` WHERE `mail`='{$mail}')";
    $stmt = $pdo->query($sql);
    $gate = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $res = array(
        "code" => "1",
        "des" => "success",
        "info" => $gate[0]
    );
    echo json_encode($res);

}else {
    echo no_para();
}