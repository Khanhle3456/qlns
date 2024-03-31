<?php
    include_once('common/header.php');
    include_once('services/nhanvien.php');
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

    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src=""></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
    <script src="js/menu.js"></script>
</head>

<body class="sb-nav-fixed">
<?php loadMenu() ?>
        <div id="layoutSidenav_content">
            <main class="main">
                <div class="col-sm-12 header-sp">
                    <div class="row">
                        <div class="col-md-3">
                            <a href="addnhanvien" class="btn btn-success"><i class="fa fa-plus"></i> Thêm nhân viên</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="wrapper">
                        <table id="example" class="table table-striped tablefix">
                            <thead class="thead-tablefix">
                                <tr>
                                    <th>id</th>
                                    <th>Ảnh</th>
                                    <th>Tên nhân viên</th>
                                    <th>Chức vụ</th>
                                    <th>Email</th>
                                    <th>Ngày sinh</th>
                                    <th>Phòng ban</th>
                                    <th class="sticky-col">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $result = getAllNhanVien();
                                    foreach($result as $re){ //Vòng lặp(gtri khi thêm nv gán cho biến $re).
                                ?>
                                <tr>
                                    <td><?php echo $re['id']?></td>
                                    <td><img src="<?php echo $re['anh']?>" class="imgstory"></td>
                                    <td><?php echo $re['tennv']?></td>
                                    <td><?php echo $re['chucvu']?></td>
                                    <td><?php echo $re['email']?></td>
                                    <td><?php echo $re['ngaysinh']?></td>
                                    <td><?php echo $re['ma_pb']?></td>
                                    <td class="sticky-col">
                                        <!-- Xóa -->
                                        <a onclick="return confirm('Bạn muốn xóa nhân viên này?')" href="?delete=<?php echo $re['id']?>"><i class="fa fa-trash-alt iconaction"></i></a>
                                        <!-- Sửa -->
                                        <a href="addnhanvien?id=<?php echo $re['id']?>"><i class="fa fa-edit iconaction"></i></a>
                                        <!--Chi tiết nv -->
                                        <i onclick="chiTietNhanVien('<?php echo $re['id']?>')" data-bs-toggle="modal" data-bs-target="#modaldeail" class="fa fa-eye iconaction"></i>
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
                    <h5 class="modal-title" id="exampleModalLabel">Chi tiết nhân viên</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Mã nhân viên</label>
                            <div id="manv" class="blockcccd"></div>
                            <label>Tên nhân viên</label>
                            <div id="tennv" class="blockcccd"></div>
                            <label>Phòng ban</label>
                            <div id="mapb" class="blockcccd"></div>
                            <label>Chức vụ</label>
                            <div id="chucvu" class="blockcccd"></div>
                            <label>Ngày sinh</label>
                            <div id="ngaysinh" class="blockcccd"></div>
                            <label>Quê quán</label>
                            <div id="quequan" class="blockcccd"></div>
                            <label>Địa chỉ</label>
                            <div id="diachi" class="blockcccd"></div>
                        </div>
                        <div class="col-sm-4">
                            <label>CCCD</label>
                            <div id="cccd" class="blockcccd"></div>
                            <label>Tình trạng hôn nhân</label>
                            <div id="tinhtranghonnhan" class="blockcccd"></div>
                            <label>Lương cơ bản</label>
                            <div id="luongcoban" class="blockcccd"></div>
                            <label>Hệ số lượng</label>
                            <div id="hesoluong" class="blockcccd"></div>
                            <label>Học vấn</label>
                            <div id="hocvan" class="blockcccd"></div>
                            <label>Công tác</label>
                            <div id="congtac" class="blockcccd"></div>
                        </div>
                        <div class="col-sm-4">
                            <img id="imgnv" style="width: 100%;">
                            <label>Email</label>
                            <div id="email" class="blockcccd"></div>
                            <label>Số điện thoại</label>
                            <div id="sdt" class="blockcccd"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
var uls = new URL(document.URL)
var suc = uls.searchParams.get("success");
if(suc == 1){
    toastr.success("Xóa thành công!");
}
if (performance.navigation.type == performance.navigation.TYPE_RELOAD) {
    window.location.href = 'nhanvien';
}

$(document).ready(function() {
    var table = $('#example').DataTable( {
        lengthChange: false,
        buttons: [ 'excel', 'colvis' ]
    } );
    table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
    // table.column(0).visible(false);
} );

async function chiTietNhanVien(id) {
    var url = 'http://localhost:81/qlns/admin/services/nhanvienjson?id=' + id;
    const response = await fetch(url, {
        method: 'GET'
    });
    //Yêu cầu truy cập tài nguyên rồi trả về 1 đối tượng response
    var obj = await response.json();
    console.log(obj);//Viết đối tượng obj vào bảng 
    //Thay đổi nội dung 
    document.getElementById("manv").innerHTML = obj.id;
    document.getElementById("tennv").innerHTML = obj.tennv;
    document.getElementById("chucvu").innerHTML = obj.chucvu;
    document.getElementById("email").innerHTML = obj.email;
    document.getElementById("ngaysinh").innerHTML = obj.ngaysinh;
    document.getElementById("quequan").innerHTML = obj.quequan;
    document.getElementById("diachi").innerHTML = obj.diachi;
    document.getElementById("mapb").innerHTML = obj.ma_pb;
    document.getElementById("cccd").innerHTML = obj.cccd;
    document.getElementById("tinhtranghonnhan").innerHTML = obj.tinhtranghonnhan;
    document.getElementById("luongcoban").innerHTML = formatmoney(obj.luongcoban);
    document.getElementById("hocvan").innerHTML = obj.hocvan;
    document.getElementById("hesoluong").innerHTML = obj.hesoluong;
    document.getElementById("congtac").innerHTML = obj.congtac;
    document.getElementById("sdt").innerHTML = obj.sdt;
    document.getElementById("imgnv").src = obj.anh;
}
//Định dạng tiền
function formatmoney(money) {
    const VND = new Intl.NumberFormat('vi-VN', {
        style: 'currency',// Định dạng kiểu tiền tệ
        currency: 'VND',
    });
    return VND.format(money);
}

 </script>
</html>