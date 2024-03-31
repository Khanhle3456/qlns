<?php
    function getAllChamCong(){
        $month = date('m');
        $year = date("Y");
        if(isset($_GET['month'])  && isset($_GET['year'])){
            $month = $_GET['month'];
            $year = $_GET['year'];
        }
        $sql = "select n.*, pb.ten as tenpb, 
        (SELECT cc.hesoluong from chamcong cc where cc.nhanvien_id = n.id and cc.thang = $month and cc.nam = $year limit 1) as heslnv,
        (SELECT cc.luongcoban from chamcong cc where cc.nhanvien_id = n.id and cc.thang = $month and cc.nam = $year limit 1) as luongcbnv,
                (SELECT sum(cc.so_cong) from chamcong cc WHERE cc.thang = $month and nam = $year and nhanvien_id = n.id) as songaycong,
                (select sum(tp.sotien) from thuongphat tp WHERE nhanvien_id = n.id and month(tp.ngaytao) = $month and year(tp.ngaytao) = $year and loai = 0) as tongthuong,
                (select sum(tp.sotien) from thuongphat tp WHERE nhanvien_id = n.id and month(tp.ngaytao) = $month and year(tp.ngaytao) = $year and loai = 1) as tongphat
                from nhanvien n inner join phongban pb on pb.ma_pb = n.ma_pb ";
        $result = executeresult($sql);
        return $result;
    }

?>