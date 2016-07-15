<?php
/**
 * Created by IntelliJ IDEA.
 * User: Leo
 * Date: 2016/3/15
 * Time: 20:14
 * 构建常用的json返回值
 */
$pdo = connect();
function connect() {
    $dsn = 'mysql:dbname=zigsys;host=jlshix.com';
    $user = 'root';
    $password = 'aili4718';

    try {
        $pdo = new PDO($dsn, $user, $password);
        header('Content-Type: text/html; charset=UTF-8');
        $pdo->query("SET NAMES 'UTF8'");
        return $pdo;
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        return null;
    }
}





function test() {
    $content = array(
        "imei" => "ASDFGHJKL",
        "name" => "HAHA",
        "place" => "Bedroom",
        "isOn" => "true"

    );
    $contents = array($content, $content, $content);
    $arr = array(
        "code" => "1",
        "count" => "3",
        "content" => $contents
    );
    echo json_encode($arr);
}

/**
 * 成功时返回json code为1
 * @return string
 */
function success() {
    $arr = array(
        "code" => "1",
        "des" => "success"
    );
    return json_encode($arr);
}

/**
 * 失败时返回json code为0
 * @return string
 */
function fail() {
    $arr = array(
        "code" => "0",
        "info"=>"{}",
        "des"=>"fail"
    );
    return json_encode($arr);
}

function no_para() {
    $arr = array(
        "code" => "-1",
        "info"=>"{}",
        "des" => "no parameter"
    );
    return json_encode($arr);
}

function no_mail() {
    $arr = array(
        "code" => "2",
        "info"=>"{}",
        "des"=>"no mail"
    );
    return json_encode($arr);
}

function wrong_pw() {
    $arr = array(
        "code" => "3",
        "info"=>"{}",
        "des"=> "wrong password"
    );
    return json_encode($arr);
}

function no_device() {
    $arr = array(
        "code" => "4",
        "info"=>"{}",
        "des"=>"no device"
    );
    return json_encode($arr);
}


/**
 * 获取账号信息
 * @param $pdo
 * @param $mail
 * @return mixed
 */
function get_account($pdo, $mail) {
    $sql = "SELECT `mail`,`account`.`name`,`imei`,`gate`.`name` FROM `account`,`gate` WHERE `gate_imei`=`gate`.`imei` AND `mail`='{$mail}'";
    $stmt = $pdo->query($sql);
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $res[0];

}

