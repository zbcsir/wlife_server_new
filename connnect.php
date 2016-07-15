<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 2016/6/17
 * Time: 11:57
 */
function connect() {
    $dsn = 'mysql:dbname=你的数据库名;host=你的服务器域名';
    $user = '用户名';
    $password = '密码';

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