<?php
    include_once('common/header.php');
    include_once('services/nhanvien.php');
    include_once('services/phongban.php');
    include_once('services/upload.php');
    if (isset($_POST['submitNhanVien'])) {
        saveOrUpdateNhanVien();
    }
    $nhanvien = loadNhanVienById();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
    <link href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js"></script>
    <script src="js/menu.js"></script>
</head>

<body class="sb-nav-fixed">
    <?php loadMenu() ?>
        <div id="layoutSidenav_content">
            <main class="main">
                <form onsubmit="return saveData()" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-4">
                            <label class="lb-form">Tên nhân viên</label>
                            <input id="tennv" value="<?=$nhanvien == null?'':$nhanvien['tennv']?>" name="tennv" type="text" class="form-control">

                            <label class="lb-form">Ảnh</label>
                            <input name="fileimage" id="fileimage" type="file" class="form-control">
                            <img id="imgpreview" style="width: 120px; margin-top: 15px;margin-bottom: 15px;display: block;">
                            <input value="<?=$nhanvien == null?'':$nhanvien['anh']?>" name="anh" type="hidden" >

                            <label class="lb-form">Chức vụ</label>
                            <input id="" value="<?=$nhanvien == null?'':$nhanvien['chucvu']?>" name="chucvu" type="text" class="form-control">
                            
                            <label class="lb-form">Số điện thoại</label>
                            <input value="<?=$nhanvien == null?'':$nhanvien['sdt']?>" name="sdt" type="text" class="form-control">
                            
                            <label class="lb-form">Ngày sinh</label>
                            <input type="date" value="<?=$nhanvien == null?'':$nhanvien['ngaysinh']?>" name="ngaysinh" class="form-control">

                            <label class="lb-form">Phòng ban</label>
                            <select name="mapb" class="form-control">
                                <?php echo loadAllPhongBanSelect() ?>
                            </select>
                            <label class="lb-form">Tình trạng hôn nhân</label>
                            <select id="selecthonnhan" name="tinhtranghonnhan" class="form-control">
                                <option value="Chưa kết hôn">Chưa kết hôn</option>
                                <option value="Đã kết hôn">Đã kết hôn</option>
                            </select>
                            <input id="tinhtranghonnhan" type="hidden" value="<?=$nhanvien == null?'':$nhanvien['tinhtranghonnhan']?>">
                            <br><br>
                            <button name="submitNhanVien" class="btn btn-success form-control action-btn">Thêm/ Cập nhật nhân viên</button>
                        </div>
                        <div class="col-sm-4">
                            <label class="lb-form">Quê quán</label>
                            <input value="<?=$nhanvien == null?'':$nhanvien['quequan']?>" name="quequan" type="text" class="form-control">
                            <label class="lb-form">Địa chỉ</label>
                            <input value="<?=$nhanvien == null?'':$nhanvien['diachi']?>" name="diachi" type="text" class="form-control">
                            <label class="lb-form">CCCD</label>
                            <input value="<?=$nhanvien == null?'':$nhanvien['cccd']?>" name="cccd" type="text" class="form-control">
                            <label class="lb-form">Lương cơ bản</label>
                            <input value="<?=$nhanvien == null?'':$nhanvien['luongcoban']?>" name="luongcoban" type="text" class="form-control">
                            <label class="lb-form">Hệ số lương</label>
                            <input value="<?=$nhanvien == null?'':$nhanvien['hesoluong']?>" name="hesoluong" type="text" class="form-control">
                            <label class="lb-form">Học vấn</label>
                            <select id="hocvanselect" name="hocvan" class="form-control">
                                <option value="Không">Không</option>
                                <option value="Trung học cơ sở">Trung học cơ sở</option>
                                <option value="Trung học phổ thông">Trung học phổ thông</option>
                                <option value="Đại học">Đại học</option>
                                <option value="Thạc sĩ">Thạc sĩ</option>
                                <option value="Khác">Khác</option>
                            </select>
                            <input id="hocvan" type="hidden" value="<?=$nhanvien == null?'':$nhanvien['hocvan']?>">
                        </div>
                        <div class="col-sm-4">
                            <label class="lb-form">Email</label>
                            <input name="email" value="<?=$nhanvien == null?'':$nhanvien['email']?>" class="form-control">

                            <label class="lb-form">Tên đăng nhập</label>
                            <input name="iduser" value="<?=$nhanvien == null?'':$nhanvien['user_id']?>" class="form-control" type="hidden">
                            <input name="tendn" value="<?=$nhanvien == null?'':$nhanvien['username']?>" class="form-control">

                            <label class="lb-form">Mật khẩu <?=$nhanvien == null?'':'(Để trống để sử dụng mật khẩu cũ)'?></label>
                            <input type="password" name="matkhau" class="form-control">

                            <label class="lb-form">Quyền</label>
                            <select name="quyen" value="<?=$nhanvien == null?'':$nhanvien['quyen']?>" class="form-control">
                                <option value="ROLE_EMPLOYEE">Nhân viên</option>
                                <option value="ROLE_ADMIN">Admin</option>
                            </select>

                            <label class="lb-form">Công tác</label>
                            <textarea id="editor"><?=$nhanvien == null?'':$nhanvien['congtac']?></textarea>
                            <textarea id="content" name="congtac" style="width:0px;height:0px">
                                <?=$nhanvien == null?'':$nhanvien['congtac']?>
                            </textarea>
                        </div>
                    </div>
                </form>
            </main>
        </div>
    </div>
</body>
<script>
fileimage.onchange = evt => {
    const [file] = fileimage.files
    if (file) {
        imgpreview.src = URL.createObjectURL(file)
    }
}
var uls = new URL(document.URL)
var suc = uls.searchParams.get("error");
var id = uls.searchParams.get("id");
if(suc != null){
    toastr.error(suc);
}
if (performance.navigation.type == performance.navigation.TYPE_RELOAD) {
    if(id != null){
        window.location.href = 'addnhanvien?id='+id;
    }
   else{
    window.location.href = 'addnhanvien';
   }
}
</script>

<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea#editor',
    });
    function saveData(){
        // kiem tra ten nhan vien co trống hay không
        var tennv =  document.getElementById("tennv").value
        if(tennv.length == 0){
            alert("Tên nhân viên không được để trống");
            return false;
        }


        var content = tinyMCE.get('editor').getContent()
        document.getElementById("content").value = content;
    }
    document.getElementById("selecthonnhan").value = document.getElementById("tinhtranghonnhan").value
    document.getElementById("hocvanselect").value = document.getElementById("hocvan").value
</script>
</html>