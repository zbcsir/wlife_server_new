<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 2016/7/20
 * Time: 22:48
 *
 * 用于设备重命名
 * 参数: gate type no name
 * 描述: update set name where gate type no
 * 返回: 成功返回 success() 失败返回相应错误码与描述 参见data.php
 */

require_once "data.php" ;
if(isset($_POST['gate']) && isset($_POST['type']) && isset($_POST['no']) && isset($_POST['name'])){
    $gate = $_POST['gate'] ;
    $type = $_POST['type'] ;
    $no = $_POST['no'] ;
    $name = $_POST['name'] ;
    $sql = "UPDATE `device` SET `name`='{$name}' WHERE gate='{$gate}' AND type='{$type}' AND no='{$no}'" ;
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

