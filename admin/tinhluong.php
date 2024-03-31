<?php
    include_once('common/header.php');
    include_once('services/chamcong.php');
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
    <script src="js/salary.js"></script>
</head>

<body class="sb-nav-fixed">
<?php loadMenu() ?>
        <div id="layoutSidenav_content">
            <main class="main">
                <div class="col-sm-12 header-sp">
                    <form class="row">
                        <div class="col-md-2">
                            <label class="lb-form">chọn tháng</label>
                            <select name="month" id="month" class="form-control">
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="lb-form">chọn năm</label>
                            <select name="year" id="year" class="form-control">
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="lb-form">&ThinSpace;</label><br>
                            <button class="btn btn-primary form-control"><i class="fa fa-filter"></i> Lọc</button>
                        </div>
                    </form>
                </div>
                <div class="col-sm-12">
                    <div class="wrapper">
                        <table id="example" class="table table-striped tablefix">
                            <thead class="thead-tablefix">
                                <tr>
                                    <th>STT</th>
                                    <th>Mã nhân viên</th>
                                    <th>Tên nhân viên</th>
                                    <th>Phòng ban</th>
                                    <th>Chức vụ</th>
                                    <th>Ngày công</th>
                                    <th>Lương cơ bản</th>
                                    <th>Tổng thưởng</th>
                                    <th>Tổng phạt</th>
                                    <th>Hệ số lương</th>
                                    <th>BHXH</th>
                                    <th>BHYT</th>
                                    <th>BHTN</th>
                                    <th>Cộng</th>
                                    <th style="background-color: #fff308 !important;" class="sticky-col">Tổng lương nhận</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $result = getAllChamCong();
                                    $i = 0;
                                    foreach($result as $re){ 
                                    $songaylam = $re['songaycong']==null?0:$re['songaycong'];
                                    $bhxh = $re['luongcbnv']*8/100;
                                    $bhyt = $re['luongcbnv']*1.5/100;
                                    $bhtn = $re['luongcbnv']*1/100;
                                    $tongthuong = $re['tongthuong']==null?0:$re['tongthuong'];
                                    $tongphat = $re['tongphat']==null?0:$re['tongphat'];
                                    $tongtru = $bhxh + $bhyt + $bhtn;
                                    $tongluong=0 ;
                                    if($songaylam > 0){
                                        $tongluong = $re['luongcbnv']/ 26* $songaylam*$re['heslnv']+$tongthuong-$tongphat-$tongtru;
                                    }
                                ?>
                                <tr>
                                    <td><?php echo ++$i; ?></td>
                                    <td><?php echo $re['id']; ?></td>
                                    <td><?php echo $re['tennv']; ?></td>
                                    <td><?php echo $re['tenpb']; ?></td>
                                    <td><?php echo $re['chucvu']; ?></td>
                                    <td><?php echo $songaylam ?></td>
                                    <td class="sotiencl"><?php echo $re['luongcbnv']; ?></td>
                                    <td class="sotiencl"><?php echo $tongthuong ?></td>
                                    <td class="sotiencl"><?php echo $tongphat ?></td>
                                    <td><?php echo $re['heslnv']; ?></td>
                                    <td class="sotiencl"><?php echo $bhxh ?></td>
                                    <td class="sotiencl"><?php echo $bhyt ?></td>
                                    <td class="sotiencl"><?php echo $bhtn ?></td>
                                    <td class="sotiencl"><?php echo $tongtru ?></td>
                                    <td style="background-color: #fff308 !important;" class="sotiencl sticky-col"><?php echo $tongluong ?></td>
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
window.onload = function(){
    checkMonth();
}
function checkMonth(){
    var uls = new URL(document.URL)
    var month = uls.searchParams.get("month");
    var year = uls.searchParams.get("year");
    if(month != null && year != null){
        document.getElementById("month").value= month
        document.getElementById("year").value= year
    }
}
 </script>
</html>