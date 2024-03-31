<?php
include_once('../../database/connect.php');
header('Content-Type: application/json');
$listre= json_decode(file_get_contents("php://input"), true);

$thang = $_GET['thang'];
$nam = $_GET['nam'];

$sql = "insert into chamcong(thu,ngay,thang,nam,full_date,nhanvien_id,luongcoban, hesoluong) values";
$listEmp = executeresult(
    "SELECT n.id, n.luongcoban, n.hesoluong   
    from nhanvien n where (SELECT count(c.id) from chamcong c 
    where c.nhanvien_id = n.id and c.thang = '$thang' and c.nam = '$nam') = 0 
    or (SELECT count(c.id) from chamcong c where c.nhanvien_id = n.id and c.thang = '$thang' and c.nam = '$nam') IS null"
);

foreach($listEmp as $emp){
    $idnv = $emp['id'];
    $luongcb = $emp['luongcoban'];
    $hesoluong = $emp['hesoluong'];
    for($i=0; $i<sizeof($listre); $i++){
        $re = $listre[$i];
        $thu = $re['thu'];
        $ngay = $re['ngay'];
        $thang = $re['thang'];
        $nam = $re['nam'];
        $day = $re['day'];
       
        $sql .= "('$thu','$ngay','$thang','$nam','$day',$idnv, $luongcb,$hesoluong),";
    }
}
$sql = substr_replace($sql ,"",-1);
execute($sql);


if(isset($_GET['month']) && isset($_GET['year']) ){
    $month = $_GET['month'];
    $year = $_GET['year'];
    $sql = "select * from chamcong where thang = '$month' and nam = '$year'";
    $result = executeresult($sql);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($result);
}
?>