<?php
include_once('../database/connect.php');
session_start();
ob_start();
if(!isset($_SESSION['user'])){
    header('Location:../index');
}
else{
    if($_SESSION['user']['quyen'] != "ROLE_ADMIN"){
        header('Location:../index');
    }
}
    function loadMenu(){
        echo 
    '<nav id="top" class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="index.html">Quản trị hệ thống</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0"></form>
        <ul id="menuleft" class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4"> </ul>
    </nav>
    <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link" href="taikhoan">
                            <div class="sb-nav-link-icon"><i class="fas fa-user-alt iconmenu"></i></div>
                            Tài khoản
                        </a>
                        <a class="nav-link" href="phongban">
                            <div class="sb-nav-link-icon"><i class="fas fa-table iconmenu"></i></div>
                            Phòng ban
                        </a>
                        <a class="nav-link" href="nhanvien">
                            <div class="sb-nav-link-icon"><i class="fas fa-user iconmenu"></i></div>
                            Nhân viên
                        </a>
                        <a class="nav-link" href="khenthuong">
                            <div class="sb-nav-link-icon"><i class="fa fa-file iconmenu"></i></div>
                            Thưởng/ phạt
                        </a>
                        <a class="nav-link" href="chamcong">
                            <div class="sb-nav-link-icon"><i class="fas fa-calendar iconmenu"></i></div>
                            Chấm công
                        </a>
                        <a class="nav-link" href="tinhluong">
                            <div class="sb-nav-link-icon"><i class="fa fa-coins iconmenu"></i></div>
                            Tính lương
                        </a>
                        <a class="nav-link" href="?logout=true">
                            <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt iconmenu"></i></div>
                            Đăng xuất
                        </a>
                    </div>
                </div>
            </nav>
        </div>';
    }

    function logout() {
        unset($_SESSION['user']);
        header('Location:../index');
    }
    
    if (isset($_GET['logout'])) {
        logout();
    }
?>