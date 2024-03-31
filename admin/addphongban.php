<?php
    include_once('common/header.php');
    include_once('services/upload.php');
    include_once('services/phongban.php');
    if (isset($_POST['submitAddPhongBan'])) {
        addPhongBan();
    }
    $phongban = loadAPhongBan();
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
            <form method="post" enctype="multipart/form-data">
                <main class="main row">
                    <div class="col-sm-5">
                        <label class="lb-form">Mã phòng ban</label>
                        <input <?=$phongban == null?'':'readonly'?> value="<?=$phongban == null?'':$phongban['ma_pb']?>" name="mapb" type="text" class="form-control">
                        <label class="lb-form">Tên phòng ban</label>
                        <input value="<?=$phongban == null?'':$phongban['ten']?>" name="ten" type="text" class="form-control">
                        <label class="lb-form">Số điện thoại phòng ban</label>
                        <input value="<?=$phongban == null?'':$phongban['sdt']?>" name="sdt" type="text" class="form-control">
                        <label class="lb-form">Ảnh nhân viên</label>
                        <input name="fileimage" id="fileimage" type="file" class="form-control">
                        <input value="<?=$phongban == null?'':$phongban['anh']?>" name="anh" type="hidden" >
                        <br><br><button name="submitAddPhongBan" class="btn btn-success form-control action-btn">Thêm/ Cập nhật phòng ban</button>
                    </div>
                    <div class="col-sm-3">
                        <img src="<?=$phongban == null?'':$phongban['anh']?>" id="imgpreview" style="width: 100%; margin-top: 15px;margin-bottom: 15px;display: block;">
                    </div>
                </main>
            </form>
        </div>
    </div>
</body>
<script>
    //Bắt skien khi thay đổi ảnh
    fileimage.onchange = evt => {
        const [file] = fileimage.files
        if (file) {
            imgpreview.src = URL.createObjectURL(file)
        }
    }
</script>
</html>