<?php
include_once('../../database/connect.php');

//thong tin nhan vien bang ma phong ban
if(isset($_GET['mapb'])){
    $mapb = $_GET['mapb'];
    $sql = "select * from nhanvien where ma_pb = '$mapb'";
    $data = executeresult($sql);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);
}

//thong tin nhan vien bang id
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "select * from nhanvien where id = '$id'";
    $result = executeresult($sql);
    $data = $result[0];
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);
}


if(isset($_GET['allemp'])){
    $sql = "select * from nhanvien";
    $data = executeresult($sql);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);
}
?>