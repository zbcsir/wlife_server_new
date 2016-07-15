<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/6/13
 * Time: 21:37
 */
require_once 'data.php';
if (isset($_GET['ssno'])){
    $ssno=$_GET['ssno'];
    //echo $ssno;
    $pdo=connect();
    $sql="select * from `Mysql` where `sno`='{$ssno}' ";
    $a=$pdo->query($sql);
    $b=$a->fetchAll(PDO::FETCH_ASSOC);
    //echo json_encode($b[0]);
    echo urldecode(json_encode(array_map('urlencode', $b[0])));
}else{
    echo "Error";
}


