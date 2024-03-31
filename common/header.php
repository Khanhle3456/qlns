<?php
include_once('database/connect.php');
session_start();
ob_start();

function loadHeader(){
    $authen = '<a href="index" class="pointermenu gvs"><i class="fa fa-sign-in"> Đăng nhập</i></a>';
    if (isset($_SESSION['user'])){
        $authen =
        '<a href="taikhoan" class="pointermenu gvs"><i class="fa fa-user"> Tài khoản</i></a>
        <a href="?logout=true" class="pointermenu gvs"><i class="fa fa-sign-out"> Đăng xuất</i></a>';
    }

    $main = 
    '
    <nav class="navbar navbar-expand-lg" style="padding-top:10px">
        <div class="container-fluid">
            <span class="navbar-toggler"><button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button></span>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            </ul>
            <div class="d-flex">
            <a href="nhanvien" class="pointermenu rightmn"><i class="fa fa-user"> Nhân viên</i></a>
            '.$authen.'
            </div>
            <form action="nhanvien" class="d-flex searchmenu">
                 <input name="search" class="imputsearchmenu" placeholder="Tìm kiếm nhân viên">
                 <button class="btnsearchmenu"><i class="fa fa-search"></i></button>
             </form>
        </div>
    </nav>';
    echo $main;
}

function logout() {
    unset($_SESSION['user']);
    header('Location:index');
}

if (isset($_GET['logout'])) {
    logout();
}
?>