<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 2016/7/20
 * Time: 22:48
 *
 * 用于转让管理员权限
 * 参数: gate name pw new_name
 * 描述: 先验证密码再 update gate set master = new_name where gate
 * 返回: 成功返回 success() 失败返回相应错误码与描述 参见data.php
 */

require_once "data.php" ;
if(isset($_POST['gate']) && isset($_POST['name']) && isset($_POST['pw']) && isset($_POST['new_name'])){
    $gate = $_POST['gate'] ;
    $name = $_POST['name'] ;
    $pw = $_POST['pw'] ;
    $new_name = $_POST['new_name'] ;
    $sql_select = "SELECT `pw` FROM `account` WHERE name='{$name}'" ;
    $sql_update = "UPDATE `gate` SET `master`='{$new_name}' WHERE gate='{$gate}'" ;
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