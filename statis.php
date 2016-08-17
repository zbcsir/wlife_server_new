<?php
/**
 * Created by PhpStorm.
 * User: zbc
 * Date: 2016/8/13
 * Time: 20:45
 * 参数：date(日期)，gimei(网关imei)，nodeid(节点id)
 */
require_once 'data.php' ;
if(isset($_POST['date']) && isset($_POST['gimei']) && isset($_POST['nodeid'])){
    $date = $_POST['date'] ;
    $gImei = $_POST['gimei'] ;
    $nodeId = $_POST['nodeid'] ;
    $sql = "SELECT `state` FROM `statistics` WHERE `gate`='{$gImei}' AND `no`='{$nodeId}' AND 
`date`='{$date}' AND `time` IS NULL" ;
    $stmt = $pdo->query($sql) ;
    $res = $stmt->fetch() ;
    if($stmt->rowCount() == 1){
        $res_success = array(
           "code" => "statis",
            "info" => "{$res[0]}",
            "des" => "average state"
        ) ;
        echo json_encode($res_success) ;
    }else{
        $res_fail = array(
            "code" => "statis",
            "info" => "0",
            "des" => "average state"
        ) ;
        echo json_encode($res_fail) ;
    }

}else{
    echo no_para() ;
}