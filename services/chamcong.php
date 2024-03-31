<?php
include_once('../database/connect.php');
session_start();
ob_start();
$id = $_SESSION['user']['id'];
$month = date('m');
$year = date("Y");
if(isset($_GET['month'])  && isset($_GET['year'])){
    $month = $_GET['month'];
    $year = $_GET['year'];
}
$sql = "select n.*, pb.ten as tenpb,
(SELECT sum(cc.so_cong) from chamcong cc WHERE cc.thang = $month and nam = $year and nhanvien_id = n.id) as songaycong,
(select sum(tp.sotien) from thuongphat tp WHERE nhanvien_id = n.id and month(tp.ngaytao) = $month and year(tp.ngaytao) = $year and loai = 0) as tongthuong,
(select sum(tp.sotien) from thuongphat tp WHERE nhanvien_id = n.id and month(tp.ngaytao) = $month and year(tp.ngaytao) = $year and loai = 1) as tongphat
from nhanvien n inner join phongban pb on pb.ma_pb = n.ma_pb where n.user_id = $id";
$result = executeresult($sql);
header('Content-Type: application/json; charset=utf-8');
echo json_encode($result);

?>