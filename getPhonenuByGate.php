<?php
/**
 * Created by PhpStorm.
 * User: zbc
 * Date: 2016/8/9
 * Time: 21:08
 */
require_once 'data.php' ;
if(isset($_POST['buildingnumber']) && isset($_POST['housenumber'])){
    $housegate = $_POST['buildingnumber'] ;
    $houseNumber = $_POST['housenumber'] ;
    $sql_getImei = "SELECT `imei` FROM `gate` WHERE `buildingImei`={$housegate} AND `housenu`={$houseNumber}" ;
//  $sql_test = "SELECT `gimei` FROM `houseGate` WHERE `bulidingImei`='12345' AND `housenu`='502'" ;
    $stmt_imei = $pdo->query($sql_getImei) ;
    $res_imei = $stmt_imei->fetch() ;
    if($stmt_imei->rowCount() == 1){
        $gimei = $res_imei[0] ;
        $sql_getPhone = "SELECT `mail` FROM `account` WHERE `gate_imei`={$gimei} AND `online`='1' LIMIT 0,1" ;
        $stmt_phone = $pdo->query($sql_getPhone) ;
        if($stmt_phone->rowCount() == 1){
            $res_phone = $stmt_phone->fetch() ;
            $phone_Info_success = array(
               "code" => "5",
                "info" =>"{$res_phone[0]}",
                "des" => "firstphonenumber"
            ) ;
            echo json_encode($phone_Info_success) ;
        }else{
            $phone_Info_fail = array(
                "code" => "5",
                "info" =>"0",
                "des" => "firstphonenumber"
            ) ;
            echo json_encode($phone_Info_fail) ;
        }
    }
}else{
    echo no_para() ;
}
