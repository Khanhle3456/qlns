<?php 
include_once('../../database/connect.php');
if(isset($_GET['id']) && isset($_GET['giatri'])){
    $socong = $_GET['giatri'];
    $id = $_GET['id'];
    $sql = "update chamcong set so_cong = $socong where id= $id";
    $data = execute($sql);
}
?>