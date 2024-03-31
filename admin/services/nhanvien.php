<?php

function getAllNhanVien(){
    $sql = "select * from nhanvien order by id desc";
    $result = executeresult($sql);
    return $result;
}


function saveOrUpdateNhanVien(){
    $anh = $_POST['anh'];
    if ($_FILES['fileimage']['error'] == 4 || ($_FILES['fileimage']['size'] == 0 && $_FILES['fileimage']['error'] == 0)){}//Ktra cách tải file ảnh lỗi
    else{
        $tmp_file = $_FILES['fileimage']['tmp_name'];
        $anh = uploadFile($tmp_file);
    }
    $tennv = $_POST['tennv'];
    $chucvu = $_POST['chucvu'];
    $ngaysinh = $_POST['ngaysinh'];
    $mapb = $_POST['mapb'];
    $email = $_POST['email'];
    $tendn = $_POST['tendn'];
    $matkhau = md5($_POST['matkhau']); //md5 chuỗi hàm băm ktra mk nhập vào có khớp ko
    $quyen = $_POST['quyen'];
    $iduser = $_POST['iduser'];

    $quequan = $_POST['quequan'];
    $diachi = $_POST['diachi'];
    $cccd = $_POST['cccd'];
    $tinhtranghonnhan = $_POST['tinhtranghonnhan'];
    $luongcoban = $_POST['luongcoban'];
    $hesoluong = $_POST['hesoluong'];
    $hocvan = $_POST['hocvan'];
    $congtac = $_POST['congtac'];
    $sdt = $_POST['sdt'];

    // Ktra id nv nhập vào có tồn tại trc đó ko
    if (!isset($_GET['id'])) {
        if(checkUserName($tendn)){
            header("location:addnhanvien?error=tên đăng nhập đã tồn tại");
        }
        $sqluser = "insert into users(username,password,trangthai,quyen) values ('$tendn','$matkhau',1,'$quyen')";
        $iduser = insert($sqluser);
        $sqlnv = "insert into nhanvien(tennv,chucvu,anh,email,ngaysinh,ma_pb,user_id,quequan,diachi,
        cccd,tinhtranghonnhan,luongcoban,hesoluong,hocvan,congtac,sdt) values 
        ('$tennv','$chucvu','$anh','$email','$ngaysinh','$mapb','$iduser','$quequan','$diachi','$cccd','$tinhtranghonnhan',
        $luongcoban,$hesoluong,'$hocvan','$congtac','$sdt')";
        execute($sqlnv);
    }
    else{
        if(checkUserNameAndId($tendn, $_GET['id'])){
            header("location:addnhanvien?error=tên đăng nhập đã tồn tại");
        }
        $id = $_GET['id'];
        $sqlnv = "update nhanvien set tennv = '$tennv',chucvu='$chucvu',anh='$anh',email='$email',
        ngaysinh='$ngaysinh',ma_pb='$mapb',quequan='$quequan',diachi='$diachi',cccd='$cccd',tinhtranghonnhan='$tinhtranghonnhan',
        luongcoban=$luongcoban,hesoluong=$hesoluong,hocvan='$hocvan',congtac='$congtac',sdt='$sdt' where id=$id";
        execute($sqlnv);
        $sqluser = "update users set username='$tendn',password='$matkhau',quyen='$quyen' where id = $iduser";
        if($_POST['matkhau'] == ""){
            $sqluser = "update users set username='$tendn',quyen='$quyen' where id = $iduser";
        }
        $iduser = execute($sqluser);
    }
    header('location:nhanvien');
}


function checkUserName($username){
    $sql = "select * from users where username = '${username}'";
    $result = executeresult($sql);
    if(sizeof($result) > 0){
        return true;
    }
    return false;
}

function checkUserNameAndId($username, $id){
    $sql = "select * from users where username = '${username}' and id != $id";
    $result = executeresult($sql);
    if(sizeof($result) > 0){
        return true;
    }
    return false;
}


function loadNhanVienById(){
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "SELECT n.*, u.id as iduser, u.username,u.password, u.quyen,u.trangthai 
         from nhanvien n INNER join users u on u.id = n.user_id where n.id = $id";
        $result = executeresult($sql);
        if(sizeof($result) > 0){
            return $result[0];
        }
        else{
            return null;
        }
    }
    return null;
}

function loadAllPhongBanSelect(){
    $mapb = '';
    if(isset($_GET['id'])){
        $nhanvien = loadNhanVienById();
        $mapb = $nhanvien['ma_pb'];
    }
    $sql = "SELECT * from phongban";
    $result = executeresult($sql);
    $main = '';
    foreach($result as $re){
        $ac = '';
        if($re['ma_pb'] == $mapb){
            $ac = 'selected';
        }
        $main .=
        '<option '.$ac.' value="'.$re['ma_pb'].'">'.$re['ten'].'</option>';
    }
    return $main;
}


if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    deleteNhanVien($id);
}

function deleteNhanVien($id){
    $sql = "delete from nhanvien where id = ${id}";
    execute($sql);
    echo "<script>
        window.location.href = '?success=1';
    </script>";
}
?>