<?php
include_once('../database/connect.php');
session_start();
ob_start();
$id = $_SESSION['user']['id'];

$sql = "select * from nhanvien where user_id = $id";
$data = executeresult($sql);
header('Content-Type: application/json; charset=utf-8');
echo json_encode($data);

?>