<?php
require_once('config.php');

// insert, update, delete,
function execute($sql){
	$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE) or die("connect fail");
	mysqli_query($conn, $sql);
}

function insert($sql){
	$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE) or die("connect fail");
	mysqli_query($conn , $sql);
	$id = mysqli_insert_id($conn);
	return $id;
}

// thực hiện câu select 
function executeresult($sql){
	$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE) or die("connect fail");
	$resultset = mysqli_query($conn, $sql);
	$List = [];
	while ($row = mysqli_fetch_array($resultset,1)) {
		$List[] = $row;
	}return $List;
}

function querySingleResult($sql){
	$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE) or die("connect fail");
	$result = mysqli_query($conn, $sql);
	$data = mysqli_fetch_assoc($result);
	return $data;
}
?>