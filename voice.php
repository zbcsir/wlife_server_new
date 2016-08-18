<?php
/**
 * Created by PhpStorm.
 * User: Lucyuse
 * Date: 2016/8/15
 * Time: 19:55
 *
 * 支持语音控制命令包含： 打开 关闭 调亮 亮 调暗 暗  开 关
 * 被控物体包含：  窗户 窗帘 空调 开关一、二、三、四   客厅灯 卧室灯
 * 模式命令包括： 外出模式 ， 观影模式 ， 夜间模式
 * 空调模式命令包含 ： 制冷 制暖 除湿 送风
 *
 * 该文件执行逻辑
 *  1. 判断模式 ， 若包含模式控制，优先发送模式控制命令
 *  2. 如果不包含模式控制 ， 判断命令动词 ， 若存在命令动词，继续判断，否则不继续
 *  3. 寻找被控物体 ， 找到，则发送控制命令
 *
 * 参数：orderstr(识别的语音),gate(网关号)
 */
require_once 'push.php' ;
require_once 'light_opreate.php' ;

if (isset($_POST['orderstr']) && isset($_POST['gate'])) {
    $light_operate = new PWMOperate() ;
    $mode_order = array('制冷','制暖','制热','除湿','送风','外出','观影','夜间','睡眠','睡觉','自动','天黑','晚上');
    $mode_action = array('开','关','亮','暗') ;
    $mode_obj = array('窗户','窗帘','空调','客厅灯','卧室灯','客厅的灯','卧室的灯');
    $orderstr = $_POST['orderstr'];//语音识别结果文本
    $gate = $_POST['gate'] ;
    //判断模式
    $is_mode = false;
    $is_obj = false;
    $order = '00000000';
    $i = 0 ; $j = 0 ; $k = 0;
    for($i = 0 ; $i<count($mode_order);$i++){
        if (strstr($orderstr,$mode_order[$i])){
            $is_mode = true;
            break;
        }
    }
    if (!$is_mode){
        $is_action = false;
        for($j= 0 ; $j< count($mode_action) ; $j++){
            if (strstr($orderstr , $mode_action[$j])){
                $is_action = true;
                break;
            }
        }
        if ($is_action){
            for($k = 0 ; $k<count($mode_obj) ; $k++){
                if (strstr($orderstr , $mode_obj[$k])){
                    $is_obj = true;
                    break;
                }
            }
        }
    }
    //'制冷','制暖','制热','除湿','送风','外出','观影','夜间','睡眠','睡觉','自动','天黑','晚上'
    if ($is_mode){
        switch($i){
            case 0:
                $order = '0f010005';
                break;
            case 1:
                $order = '0f010006';
                break;
            case 2:
                $order = '0f010006';
                break;
            case 3:
                $order = '0f010008';
                break;
            case 4:
                $order = '0f010009';
                break;
            case 5:
                $order = '09010000,06010000,05010001';
                break;
            case 6:
                $order = '09010003,06010000';
                break;
            case 7:
                $order = '09010007,06010000';
                break;
            case 8:
                $order = '09010000,09020001,06010000' ;
                break;
            case 9:
                $order = '09010000,09020001,06010000' ;
                break ;
            case 10:
                $order = '0f010000' ;
                break ;
            case 11:
                $order = '09010007,06010000' ;
                break ;
            case 12:
                $order = '09010007,06010000' ;
                break ;
        }
    }else{
        //  $mode_action = array('开','关','亮','暗');
        //$mode_obj = array('窗户','窗帘','空调','客厅灯','卧室灯',,'客厅的灯','卧室的灯');
        if ($is_action && $is_obj){
            $p = ($j+1)*10+$k;
            switch($p){
                case 10:
                    $order = '06010001';
                    break;
                case 11:
                    $order = '06010001';
                    break;
                case 12:
                    $order = '0f010003';
                    break;
                case 13:
                    $order = '09010005';
                    break;
                case 14:
                    $order = '09020005';
                    break;
                case 15:
                    $order = '09010005';
                    break ;
                case 16:
                    $order = '09020005' ;
                    break ;
                case 20:
                    $order = '06010000';
                    break;
                case 21:
                    $order = '06010000';
                    break;
                case 22:
                    $order = '0f010004';
                    break;
                case 23:
                    $order = '09010000';
                    break;
                case 24:
                    $order = '09020000';
                    break;
                case 25:
                    $order = '09010000' ;
                    break ;
                case 26:
                    $order = '09020000' ;
                    break ;
                case 33:
                    $order = $light_operate->lighter($gate,1) ;
                    break ;
                case 34:
                    $order = $light_operate->lighter($gate,2) ;
                    break ;
                case 35:
                    $order = $light_operate->lighter($gate,1) ;
                    break ;
                case 36:
                    $order = $light_operate->lighter($gate,2) ;
                    break ;
                case 43:
                    $order = $light_operate->darker($gate,1) ;
                    break ;
                case 44:
                    $order = $light_operate->darker($gate,2) ;
                    break ;
                case 45:
                    $order = $light_operate->darker($gate,1) ;
                    break ;
                case 46:
                    $order = $light_operate->darker($gate,2) ;
                    break ;
            }
        }
    }
    //send order by Jpush
    gate_push($gate,$order) ;
    if(substr($order,0,2) == '09'){
        $light = (int)substr($order,7,1) ;
        $node = substr($order,2,2) ;
        $light_operate->updateLight($gate,$node,$light) ;
    }
    if($order != '00000000'){
        $res = array(
            "code" => "1",
            "info" => "执行成功",
            "des" => "order"
        ) ;
        $json_res = json_encode($res) ;
        echo $json_res;
    }else{
        $res = array(
            "code" => "1",
            "info" => "执行失败",
            "des" => "order"
        ) ;
        $json_res = json_encode($res) ;
        echo $json_res;
    }

} else {
    echo 'nothing0';
}