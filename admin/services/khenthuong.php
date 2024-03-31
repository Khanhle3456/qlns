<?php

function getAllKhenThuong(){
    $sql = "select t.*,n.tennv,n.ma_pb,
    (SELECT sum(tp.sotien) from thuongphat tp where tp.loai = 0 and tp.nhanvien_id = n.id) as phat,
    (SELECT sum(tp.sotien) from thuongphat tp where tp.loai = 1 and tp.nhanvien_id = n.id) as thuong
    from thuongphat t inner join nhanvien n on n.id = t.nhanvien_id order by id desc";
    if(isset($_GET['from']) && isset($_GET['to'])){
        $from = $_GET['from'];
        $to = $_GET['to'];
        if($from != "" && $to != ""){
            // $sql = "select * from thuongphat where ngaytao >= '$from' and ngaytao <= '$to' order by id desc";
            $sql = "select t.*,n.tennv,n.ma_pb,
            (SELECT sum(tp.sotien) from thuongphat tp where tp.loai = 0 and tp.nhanvien_id = n.id) as phat,
            (SELECT sum(tp.sotien) from thuongphat tp where tp.loai = 1 and tp.nhanvien_id = n.id) as thuong
            from thuongphat t inner join nhanvien n on n.id = t.nhanvien_id 
            where t.ngaytao >= '$from' and t.ngaytao <= '$to' order by id desc";
        }
    }
    $result = executeresult($sql);
    return $result;
}


function addKhenThuong(){
    $tieude = $_POST['tieude'];
    $sotien = $_POST['sotien'];
    $loai = $_POST['loai'];
    $nhanvien = $_POST['nhanvien'];
    $noidung = $_POST['noidung'];
    $sql = "insert into thuongphat(tieude,noidung, nhanvien_id,loai,sotien) values 
    ('$tieude','$noidung',$nhanvien,$loai,$sotien)";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "update thuongphat set tieude = '$tieude', noidung ='$noidung',
        nhanvien_id=$nhanvien,loai=$loai,sotien=$sotien where id = $id  ";
    }
    execute($sql);
    header('Location:khenthuong');
}


function loadAKhenThuong(){
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "select * from thuongphat where id = $id";
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

function allNhanVienSelect(){
    $sql = "select * from nhanvien";
    $result = executeresult($sql);
    $main = "";
    foreach($result as $re){
        $main .= 
        '<option value="'.$re['id'].'">'.$re['id'].'-'.$re['tennv'].'-'.$re['ma_pb'].'</option>';
    }
    return $main;
}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    deleteKhenThuong($id);
}

function deleteKhenThuong($id){
    $sql = "delete from thuongphat where id = '${id}'";
    execute($sql);
    echo "<script>
        window.location.href = '?success=1';
    </script>";
}


?>