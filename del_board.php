<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 2016/7/20
 * Time: 22:48
 *
 * 用于家庭留言板删除消息
 * 参数: id gate name
 * 描述: 先判断是否为管理员再删除 id为消息id
 * 返回: 成功返回 success() 失败返回相应错误码与描述 参见data.php
 */

require_once "data.php" ;
if(isset($_POST['id']) && isset($_POST['gate']) && isset($_POST['name'])){
    $id = $_POST['id'] ;
    $gate = $_POST['gate'] ;
    $name = $_POST['name'] ;
    $sql_Select = "SELECT * FROM `account` WHERE name='{$name}' AND gate_imei='{$gate}'" ;
    $sql_Delete = "DELETE FROM `board` WHERE `id`=$id" ;
    $stmt_Select = $pdo->query($sql_Select) ;
    $rowCount_Select = $stmt_Select->rowCount() ;
    if($rowCount_Select == 1){//是管理员，可以进行删除
        $pdo->beginTransaction() ;
        $stmt_Delete = $pdo->query($sql_Delete) ;
        $rowCount_Delete = $stmt_Delete->rowCount() ;
        if($rowCount_Delete == 1){
            $pdo->commit() ;
            echo success() ;
        }else{
            $pdo->rollBack() ;
            echo fail() ;
        }
    }
}else{
    echo no_para() ;
}