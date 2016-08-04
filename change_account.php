<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 2016/7/20
 * Time: 22:48
 *
 * 用于更改账户信息
 * 参数: id name mail
 * 描述: update set name mail where id
 * 返回: 成功返回 success() 失败返回相应错误码与描述 参见data.php
 */

require_once "data.php" ;
if(isset($_POST['id']) && isset($_POST['name']) && isset($_POST['mail'])){
    $id = $_POST['id'] ;
    $name = $_POST['name'] ;
    $mail = $_POST['mail'] ;
    $sql = "UPDATE `account` SET `name`=$name,`mail`=$mail WHERE id=$id" ;
    $pdo->beginTransaction() ;
    $stmt = $pdo->query($sql) ;
    $rowCount = $stmt->rowCount() ;
    if($rowCount == 1){
        $pdo->commit() ;
        echo success() ;
    }else{
        $pdo->rollBack() ;
        echo fail() ;
    }
}else{
    echo no_para() ;
}