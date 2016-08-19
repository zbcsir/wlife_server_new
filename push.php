<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/6/15
 * Time: 10:00
 * 推送消息
 */
require_once 'JPush/JPush.php';
require_once 'data.php';

/**
 * 通过标签推送消息给App
 * @param $tag
 * @param $msg
 * @return string
 */
function app_push($tag, $msg) {
    $app_key = '38ba4f67971442bb104f6b8e';
    $master_secret='7764f00c840040ebbdac2334';
    $client = new JPush($app_key, $master_secret, null);
    $result = $client->push()
        ->setPlatform('all')
        ->addTag($tag)
        ->setNotificationAlert($msg)
        ->addAndroidNotification($msg, "ZigSys-Message")
        ->setMessage($msg)
        ->send();
    return json_encode($result);
}

/**
 * 通过标签推送消息给网关
 * @param $tag
 * @param $msg
 * @return string
 */
function gate_push($tag, $msg) {
    $app_key = '1096bce02f2116a9797c0daf';
    $master_secret='3d1796f6b7d452d0599fbc33';
    $client = new JPush($app_key, $master_secret, null);
    $result = $client->push()
        ->setPlatform('all')
//        ->addTag($tag)
        ->addAlias($tag)
        ->setMessage($msg)
        ->send();
    return json_encode($result);
}


/**
 * 通过标签推送自定义消息给App
 * @param $tag
 * @param $msg
 * @return string
 */
function app_msg($tag, $msg) {
    $app_key = '38ba4f67971442bb104f6b8e';
    $master_secret='7764f00c840040ebbdac2334';
    $client = new JPush($app_key, $master_secret, null);
    $result = $client->push()
        ->setPlatform('all')
        ->addTag($tag)
        ->setMessage($msg)
        ->send();
    return json_encode($result);
}