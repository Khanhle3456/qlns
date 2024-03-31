<?php
include_once('../database/connect.php');
session_start();
ob_start();
if(isset($_GET['month']) && isset($_GET['year']) ){
    $month = $_GET['month'];
    $year = $_GET['year'];
    $id = $_SESSION['user']['id'];
    $sql = "select c.* from chamcong c inner join nhanvien nv on nv.id = c.nhanvien_id where thang = '$month' and nam = '$year' and nv.user_id = $id";
    $result = executeresult($sql);
    if(sizeof($result) > 0){
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result);
    }
    else{
        header("HTTP/1.1 417 Fail");
    }
}
?>