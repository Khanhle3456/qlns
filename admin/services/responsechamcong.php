<?php
include_once('../../database/connect.php');
if(isset($_GET['month']) && isset($_GET['year']) ){
    $month = $_GET['month'];
    $year = $_GET['year'];
    $sql = "select * from chamcong where thang = '$month' and nam = '$year'";
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