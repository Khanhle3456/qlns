<?php
    function addPhongBan(){
        $mapb = $_POST['mapb'];
        $ten = $_POST['ten'];
        $sdt = $_POST['sdt'];
        $anh = $_POST['anh'];

        //Up ảnh
        if ($_FILES['fileimage']['error'] == 4 || ($_FILES['fileimage']['size'] == 0 && $_FILES['fileimage']['error'] == 0))
        {
            // cover_image is empty (and not an error), or no file was uploaded
        }
        else{ //Up ảnh tại cloudinary
            $tmp_file = $_FILES['fileimage']['tmp_name'];
            $anh = uploadFile($tmp_file);
        }
        $sql = "insert into phongban(ma_pb , ten, sdt, anh) values ('${mapb}', '${ten}','${sdt}','${anh}')";//Chèn dl PB
        if (isset($_GET['mapb'])) { //Ktra mã PB
            $sql = "update phongban set ten = '${ten}',sdt='${sdt}',anh='${anh}' where ma_pb= '${mapb}'"; //Cập nhật dl PB
        }
        execute($sql); 
        header('Location:phongban');
    }
    //Cập nhật thêm PB
    function loadAllPhongBan(){
        $sql = "SELECT p.*,(SELECT count(n.id) from nhanvien n where n.ma_pb = p.ma_pb) as slnhanvien FROM phongban p";
        $result = executeresult($sql);
        return $result;
    }

    function loadAPhongBan(){
        if(isset($_GET['mapb'])){
            $mapb = $_GET['mapb'];
            $sql = "select * from phongban where ma_pb = '$mapb'";
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
    //Xóa PB
    if(isset($_GET['delete'])){
        $mapb = $_GET['delete'];
        deletePhongBan($mapb);
    }

    function deletePhongBan($mapb){
        $sql = "delete from phongban where ma_pb = '${mapb}'";
        execute($sql);
        echo "<script>
            window.location.href = '?success=1';
        </script>";
    }
?>