<?php
    include_once('common/header.php');
    include_once('services/khenthuong.php');
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
                <form class="col-sm-12 header-sp">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="lb-form">&ThinSpace;</label><br>
                            <a href="addkhenthuong" class="btn btn-success"><i class="fa fa-plus"></i> Thêm khen thưởng</a>
                        </div>
                        <div class="col-md-3">
                        <label class="lb-form">Từ ngày</label>
                            <input name="from" type="date" class="form-control">
                        </div>
                        <div class="col-md-3">
                        <label class="lb-form">Đến ngày</label>
                            <input name="to" type="date" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label class="lb-form">&ThinSpace;</label><br>
                            <button class="btn btn-success">Lọc</button>
                        </div>
                    </div>
                </form>
                <div class="col-sm-12">
                    <div class="wrapper">
                        <table id="example" class="table table-striped tablefix">
                            <thead class="thead-tablefix">
                                <tr>
                                    <th>id</th>
                                    <th>Tiêu đề</th>
                                    <th>Ngày tạo</th>
                                    <th>Số tiền</th>
                                    <th>Loại</th>
                                    <th>Tên nhân viên</th>
                                    <th>Phòng ban</th>
                                    <th>Nội dung</th>
                                    <th>Tổng phạt</th>
                                    <th>Tổng thưởng</th>
                                    <th class="sticky-col">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $result = getAllKhenThuong();
                                    foreach($result as $re){ 
                                ?>
                                <tr>
                                    <td><?php echo $re['id']?></td>
                                    <td><?php echo $re['tieude']?></td>
                                    <td><?php echo $re['ngaytao']?></td>
                                    <td class="sotiencl"><?php echo $re['sotien']?></td>
                                    <td><?php echo $re['loai']==0?'<span class="phat">Phạt</span>':'<span class="thuong">Thưởng</span>'?></td>
                                    <td><?php echo $re['tennv']?></td>
                                    <td><?php echo $re['ma_pb']?></td>
                                    <td><?php echo $re['noidung']?></td>
                                    <td class="sotiencl"><?php echo $re['phat']?></td>
                                    <td class="sotiencl"><?php echo $re['thuong']?></td>
                                    <td class="sticky-col">
                                        <a onclick="return confirm('Bạn muốn xóa khen thưởng này?')" href="?delete=<?php echo $re['id']?>"><i class="fa fa-trash-alt iconaction"></i></a>
                                        <a href="addkhenthuong?id=<?php echo $re['id']?>"><i class="fa fa-edit iconaction"></i></a>
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
</body>
<script>
var uls = new URL(document.URL)
var suc = uls.searchParams.get("success");
if(suc == 1){
    toastr.success("Xóa thành công!");
}
if (performance.navigation.type == performance.navigation.TYPE_RELOAD) {
    window.location.href = 'khenthuong';
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

function formatmoney(money) {
    const VND = new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND',
    });
    return VND.format(money);
}

var st = document.getElementsByClassName("sotiencl");
for(i=0; i<st.length; i++){
    st[i].innerHTML = formatmoney(st[i].textContent);

}
 </script>
</html>