<?php
    include_once('common/header.php');
    include_once('services/phongban.php');
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
                <div class="col-sm-12 header-sp">
                    <div class="row">
                        <div class="col-md-3">
                            <a href="addphongban" class="btn btn-success"><i class="fa fa-plus"></i> Thêm phòng ban</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="wrapper">
                        <table id="example" class="table table-striped tablefix">
                            <thead class="thead-tablefix">
                                <tr>
                                    <th>Ảnh</th>
                                    <th>Mã phòng ban</th>
                                    <th>Tên phòng ban</th>
                                    <th>Số điện thoại</th>
                                    <th>Số lượng nhân viên</th>
                                    <th class="sticky-col">Hành động</th>
                                </tr>
                            </thead>
                             <tbody id="listcategory"> <!--trả về 1 cái list dsach PB-->
                                <?php 
                                    $phongban = loadAllPhongBan();
                                    foreach ($phongban as $pb){
                                ?>
                                <tr>
                                    <td><img src="<?php echo $pb['anh'] ?>" style="width:80px"></td>
                                    <td><?php echo $pb['ma_pb'] ?></td>
                                    <td><?php echo $pb['ten'] ?></td>
                                    <td><?php echo $pb['sdt'] ?></td>
                                    <td><?php echo $pb['slnhanvien'] ?></td>
                                    <td>
                                    <a onclick="return confirm('Bạn muốn xóa phòng ban này?')" href="?delete=<?php echo $pb['ma_pb'] ?>"><i class="fa fa-trash-alt iconaction"></i></a>
                                    <a href="addphongban?mapb=<?php echo $pb['ma_pb'] ?>"><i class="fa fa-edit iconaction"></i></a>
                                    <i onclick="loadANhanVien('<?php echo $pb['ma_pb']?>')" data-bs-toggle="modal" data-bs-target="#modaldeail" class="fa fa-eye iconaction"></i>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>



    <div class="modal fade" id="modaldeail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-fullscreen-sm-down modeladdres">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Danh sách nhân viên</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <table class="table table-striped tablefix">
                        <thead class="thead-tablefix">
                            <tr>
                                <th>id</th>
                                <th>Ảnh</th>
                                <th>Tên nhân viên</th>
                                <th>Chức vụ</th>
                                <th>Email</th>
                                <th>Ngày sinh</th>
                                <th>Phòng ban</th>
                            </tr>
                        </thead>
                        <tbody id="listnv">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
 $('#example').DataTable();
var uls = new URL(document.URL)
var suc = uls.searchParams.get("success");
if(suc == 1){
    toastr.success("Xóa thành công!");
}
if (performance.navigation.type == performance.navigation.TYPE_RELOAD) {
window.location.href = 'phongban';
}
async function loadANhanVien(mapb) {
    var url = 'http://localhost:81/qlns/admin/services/nhanvienjson?mapb=' + mapb;
    const response = await fetch(url, {
        method: 'GET'
    });
    var list = await response.json();
    var main = '';
    for(i=0; i<list.length; i++){
        main +=
        `<tr>
            <td>${list[i].id}</td>
            <td><img src="${list[i].anh}" style="width:80px"></td>
            <td>${list[i].tennv}</td>
            <td>${list[i].chucvu}</td>
            <td>${list[i].email}</td>
            <td>${list[i].ngaysinh}</td>
            <td>${list[i].ma_pb }</td>
        </tr>`
    }
    document.getElementById("listnv").innerHTML = main;
}
 </script>
</html>