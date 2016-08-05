<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 2016/7/20
 * Time: 22:48
 *
 * 用于网关重命名
 * 参数: imei name
 * 描述: update set
 * 返回: 成功返回 success() 失败返回相应错误码与描述 参见data.php
 */
require_once "data.php" ;
if(isset($_POST['imei']) && isset($_POST['name'])){
    $imei = $_POST['imei'] ;
    $name = $_POST['name'] ;
    $sql = "UPDATE `gate` SET `name`='{$name}' WHERE imei='{$imei}'" ;
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