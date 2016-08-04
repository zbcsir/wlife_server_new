<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/6/13
 * Time: 19:55
 * 6666777888
 *
 */
//include
require_once 'data.php';
//如果包含啥啥啥
if (isset($_GET['no']) && isset($_GET['name'])) {
    //变量本地化
    $no = $_GET['no'];
    $name = $_GET['name'];
//    echo $no;
//    echo '<br/>';
//    echo $name;

    //连接数据库
    //pdo钥匙
    $pdo = connect();
    //sql语句
    $sql = "SELECT * FROM `test` WHERE `id`='{$no}'";
    //查询动作
    $stmt = $pdo->query($sql);
    //获取结果
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);//去掉编号
    //输出结果
//    print_r($res);
//    echo '<br/>';
    //json编码输出
    echo json_encode($res[0]);


} else {
    echo no_para();
}






//补充：关于事务 updte insert
//$sql = "UPDATE `thi` SET `temp`='{$temp}',`humi`='{$humi}',`illu`='{$illu}' WHERE `thiNo`='{$thiNo}' AND `devImei`='{$devImei}'" ;
//$pdo = connect() ;
//$pdo->beginTransaction() ;
//$stat = $pdo->query($sql) ;
//$count = $stat->rowCount() ;
//if($count == 1){
//    $pdo->commit() ;
//    echo success() ;
//}
//else{
//    $pdo->rollBack() ;
//    echo fail() ;
//}


