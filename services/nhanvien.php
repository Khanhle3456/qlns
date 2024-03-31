<?php
function getNhanVienByPhongBna(){
    $sql = "select n.*,p.ten as tenpb from nhanvien n inner join phongban p on p.ma_pb = n.ma_pb";
    if(isset($_GET['mapb'])){
        $mapb = $_GET['mapb'];
        $sql = "select n.*,p.ten as tenpb from nhanvien n inner join phongban p on p.ma_pb = n.ma_pb where n.ma_pb = '$mapb'";
    }
    if(isset($_GET['mapb'])){
        $mapb = $_GET['mapb'];
        $sql = "select n.*,p.ten as tenpb from nhanvien n inner join phongban p on p.ma_pb = n.ma_pb where n.ma_pb = '$mapb'"; 
    }
    //Tìm kiếm
    if(isset($_GET['search'])){
        $search = "%".$_GET['search']."%";
        $sql = "select n.*,p.ten as tenpb from nhanvien n inner join phongban p on p.ma_pb = n.ma_pb 
        where n.email like '$search' or n.tennv like '$search' or n.email like '$search'";
    }
    $result = executeresult($sql);
    $main = "";
    foreach ($result as $re) {
        $main .= '<div class="col-lg-20 col-md-4 col-sm-6 singlenv">
        <img src="'.$re['anh'].'" class="imgnv">
        <div class="contentnv">
            <span class="block hotennv">'.$re['tennv'].'</span>
            <span class="block">phòng ban: '.$re['tenpb'].'</span>
            <a href="mailto:tutm@aladintech.co" class="block mailnv">'.$re['email'].'</a>
        </div>
    </div>';
    }
    return $main;
}

function loadNhanVienByUser() {
    $id = $_SESSION['user']['id'];
    $sql = "select * from nhanvien where user_id = $id";
    $result = executeresult($sql);
    return $result[0];
}

function updateInfor($id) {
    $diachi = $_POST['diachi'];
    $sdt = $_POST['sdt'];
    $tinhtranghonnhan = $_POST['tinhtranghonnhan'];
    $sql = "update nhanvien set diachi='$diachi', sdt='$sdt', tinhtranghonnhan='$tinhtranghonnhan' where id= $id";
    execute($sql);
    header(('location:taikhoan?updateinfor=success#infor'));
}
?>