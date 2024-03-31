<?php
    include_once('common/header.php');
    include_once('services/khenthuong.php');
    if (isset($_POST['submitAddKt'])) {
        addKhenThuong();
    }
    $khenthuong = loadAKhenThuong();
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
            <form onSubmit="saveData()" method="post">
                <main class="main row">
                    <div class="col-sm-5">
                        <label class="lb-form">Tiêu đề</label>
                        <input value="<?=$khenthuong == null?'':$khenthuong['tieude']?>" name="tieude" type="text" class="form-control">
                        <label class="lb-form">Số tiền</label>
                        <input value="<?=$khenthuong == null?'':$khenthuong['sotien']?>" name="sotien" type="text" class="form-control">
                        <label class="lb-form">Loại</label><br>
                        <label class="radio-custom">Thưởng
                            <input id="thuong" checked value="1" type="radio" name="loai"><span class="checkmark"></span>
                        </label>
                        <label class="radio-custom">Phạt
                            <input id="phat" value="0" type="radio" name="loai"><span class="checkmark"></span>
                        </label>
                        <br><label class="lb-form">Nhân viên</label>
                        <select name="nhanvien" id="listdpar" class="form-control">
                            <?php 
                                echo allNhanVienSelect();
                            ?>
                        </select>
                        <input id="idnv" value="<?=$khenthuong == null?'':$khenthuong['nhanvien_id']?>" type="hidden">
                        <input id="thuongphat" value="<?=$khenthuong == null?'':$khenthuong['loai']?>" type="hidden">
                        <br><br><button name="submitAddKt" class="btn btn-success form-control action-btn">Thêm/ Cập nhật khen thưởng</button>
                    </div>
                    <div class="col-sm-7">
                        <label class="lb-form">Nội dung</label>
                        <textarea id="editor"><?=$khenthuong == null?'':$khenthuong['noidung']?></textarea>
                        <textarea id="content" name="noidung" style="width:0px;height:0px">
                            <?=$khenthuong == null?'':$khenthuong['noidung']?>
                        </textarea>
                    </div>
                </main>
            </form>
        </div>
    </div>
</body>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea#editor',
    });
    const ser = $("#listdpar");
    ser.select2({
        placeholder: "Chọn nhân viên",
    });
    function saveData(){
        var content = tinyMCE.get('editor').getContent()
        document.getElementById("content").value = content;
    }
    var uls = new URL(document.URL)
    var id = uls.searchParams.get("id");
    if(id != null){
        $("#listdpar").val(document.getElementById("idnv").value).change();
    }
    if(document.getElementById("thuongphat").value == 0){
        document.getElementById("phat").checked = true
    }
    if(document.getElementById("thuongphat").value == 1){
        document.getElementById("thuong").checked = true
    }
</script>
</html>