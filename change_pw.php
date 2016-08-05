<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 2016/7/20
 * Time: 22:48
 *
 * 用于更改密码
 * 参数: name pw pwn
 * 描述: 先验证密码再更改
 * 返回: 成功返回 success() 失败返回相应错误码与描述 参见data.php
 */

require_once "data.php" ;
if(isset($_POST['name']) && isset($_POST['pw']) && isset($_POST['pwn'])){
    $name = $_POST['name'] ;
    $pw = $_POST['pw'] ;
    $pw_new = $_POST['pwn'] ;
    $sql_select = "SELECT `pw` FROM `account` WHERE name='{$name}'" ;
    $sql_update = "UPDATE `account` SET `pw`='{$pw_new}' WHERE name='{$name}'" ;
    $stmt = $pdo->query($sql_select) ;
    $result = $stmt->fetch() ;
    if($pw == $result['pw']){
        $pdo->beginTransaction() ;
        $stmt = $pdo->query($sql_update) ;
        $rowCount = $stmt->rowCount() ;
        if($rowCount == 1){
            $pdo->commit() ;
            echo success() ;
        }else{
            $pdo->rollBack() ;
            echo fail() ;
        }
    }else{
        echo wrong_pw() ;
    }
}else{
    echo no_para() ;
}