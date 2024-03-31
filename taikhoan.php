<?php
include_once('common/header.php');
include_once('services/user.php');
include_once('services/khenthuong.php');
include_once('services/nhanvien.php');
// Ktra nếu là user chuyển sang index
if(!isset($_SESSION['user'])){
    header('Location:index');
}
$user = $_SESSION['user'];
if (isset($_POST['submitChangePass'])) {
    changePassword();
}
if (isset($_POST['logout'])) {
    logout();
}
$nv = loadNhanVienByUser();
if (isset($_POST['submitUpdateInfor'])) {
    updateInfor($nv['id']);
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="image/logo.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer"
    /><link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="js/salary.js"></script>
</head>
<body>
<div id="menu" style="background-image: url(image/backgroundmenu.webp);">
    <?php loadHeader() ?>
</div>

<div class="content contentcart">
    <div class="row cartbds">
        <div class="col-lg-3 col-md-3 col-sm-12 col-12 collistcart">
            <div class="navleft">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-6 col-6">
                        <div class="avaaccount">
                            <img src="<?php echo $_SESSION['user']['anh'] ?>" class="avataracc">
                            <p class="fullnamacc"><?php echo $_SESSION['user']['username'] ?></p>
                            <form method="post"><button name="logout" class="btnlogoutacc">Đăng xuất</button></form>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-6 col-6 sinv">
                        <div onclick="changeLink(this,'infor')" class="tabdv activetabdv">
                            <a data-toggle="tab" href="#infor"><img class="imgau" src="image/user.svg"> Tài khoản</a>
                        </div>
                        <div onclick="changeLink(this,'khenthuong')" class="tabdv">
                            <a data-toggle="tab" href="#khenthuong"><img class="imgau" src="image/tp.svg"> Khen thưởng</a>
                        </div>
                        <div onclick="changeLink(this,'luong')" class="tabdv">
                            <a data-toggle="tab" href="#luong"><img class="imgau" src="image/tp.svg"> Chấm công & lương</a>
                        </div>
                        <div onclick="changeLink(this,'changepass')" class="tabdv">
                            <a data-toggle="tab" href="#changepass"><img class="imgau" src="image/pass.svg"> Đổi mật khẩu</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 col-12 collistcart">
            <div class="navright">
                <div class="tab-content contentab">
                    <div role="tabpanel" class="tab-pane" id="changepass">
                        <div class="headeraccount">
                            <span class="fontyel">Đổi mật khẩu</span><span class="smyl"> (Để bảo mật tài khoản, vui lòng không chia sẻ mật khẩu cho người khác)</span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12 passacc">
                            <form method="post" onsubmit="checkChangePass()">
                                <label class="lbacc">Mật khẩu hiện tại *</label>
                                <input name="oldpass" type="password" class="form-control">
                                <label class="lbacc">Mật khẩu mới *</label>
                                <input id="newpass" name="newpass" type="password" class="form-control">
                                <label class="lbacc">Xác nhận mật khẩu mới *</label>
                                <input id="renewpass" name="renewpass" type="password" class="form-control">
                                <br><button type="button" class="btnhuylogin" onclick="window.location.href='taikhoan'">HỦY</button>
                                <button name="submitChangePass" class="btntt">LƯU</button>
                            </form>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="khenthuong">
                        <div class="headeraccount">
                            <span class="fontyel">Khen thưởng và kỷ luật của bạn</span>
                        </div>
                        <table id="example" class="table table-striped tablefix">
                            <thead class="thead-tablefix">
                                <tr>
                                    <th>id</th>
                                    <th>Tiêu đề</th>
                                    <th>Ngày tạo</th>
                                    <th>Số tiền</th>
                                    <th>Loại</th>
                                    <th>Nội dung</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php echo loadKhenThuong(); ?>
                            </tbody>
                        </table>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="luong">
                        <div class="headeraccount">
                            <span class="fontyel">Chấm công & lương</span>
                        </div>
                        <div class="col-sm-12 header-sp">
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="lb-form">chọn tháng</label>
                                    <select id="month" class="form-control">
                                    
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="lb-form">chọn năm</label>
                                    <select id="year" class="form-control">

                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="lb-form">&ThinSpace;</label><br>
                                    <button onclick="loadChamCong()" class="btn btn-primary form-control"><i class="fa fa-filter"></i> Lọc</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12" style="margin-top: 50px;">
                            <h4>Bảng chấm công</h4>
                            <table class="tableluong table-bordered tablefix">
                                <thead id="theadre">
                                </thead>
                                <tbody id="listnv">
                                </tbody>
                            </table>
                            <h4 style="margin-top: 40px;">Bảng tính lương</h4>
                            <table id="example" class="table tableluong table-striped tablefix">
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
                            <tbody id="tbodyluong">
                                
                            </tbody>
                        </table>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane active" id="infor">
                        <div class="headeraccount">
                            <p class="fontyel">Thông tin tài khoản của bạn</p>
                            <div class="right_flex">
                                <button data-bs-toggle="modal" data-bs-target="#modaldeail" class="btnsuathongtin">Xem chi tiết</button>
                            </div>
                        </div>
                        <div class="contentacc" id="listaddacc">
                            <div class="row singleadd">
                                <form method="post" class="col-lg-11 col-md-11 col-sm-12 col-12">
                                    <table class="table tableadd">
                                        <tr>
                                            <td class="tdleft">Địa chỉ:</td>
                                            <td class="tdright"><input name="diachi" value="<?php echo $nv['diachi']; ?>" class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <td class="tdleft">Số điện thoại:</td>
                                            <td class="tdright"><input name="sdt" value="<?php echo $nv['sdt']; ?>" class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <td class="tdleft">Hôn nhân:</td>
                                            <td class="tdright">
                                            <select id="selecthonnhan" name="tinhtranghonnhan" class="form-control">
                                                <option value="Chưa kết hôn">Chưa kết hôn</option>
                                                <option value="Đã kết hôn">Đã kết hôn</option>
                                            </select>
                                            <input id="honnhan" value="<?php echo $nv['tinhtranghonnhan']; ?>" type="hidden">
                                            </td>
                                        </tr>
                                    </table>
                                    <button name="submitUpdateInfor" class="btntt btnluu">LƯU</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="footer">
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
                            <div id="manv" class="blockcccd"><?php echo $nv['id']; ?></div>
                            <label>Tên nhân viên</label>
                            <div id="tennv" class="blockcccd"><?php echo $nv['tennv']; ?></div>
                            <label>Phòng ban</label>
                            <div id="mapb" class="blockcccd"><?php echo $nv['ma_pb']; ?></div>
                            <label>Chức vụ</label>
                            <div id="chucvu" class="blockcccd"><?php echo $nv['chucvu']; ?></div>
                            <label>Ngày sinh</label>
                            <div id="ngaysinh" class="blockcccd"><?php echo $nv['ngaysinh']; ?></div>
                            <label>Quê quán</label>
                            <div id="quequan" class="blockcccd"><?php echo $nv['quequan']; ?></div>
                            <label>Địa chỉ</label>
                            <div id="diachi" class="blockcccd"><?php echo $nv['diachi']; ?></div>
                        </div>
                        <div class="col-sm-4">
                            <label>CCCD</label>
                            <div id="cccd" class="blockcccd"><?php echo $nv['cccd']; ?></div>
                            <label>Tình trạng hôn nhân</label>
                            <div id="tinhtranghonnhan" class="blockcccd"><?php echo $nv['tinhtranghonnhan']; ?></div>
                            <label>Lương cơ bản</label>
                            <div id="luongcoban" class="blockcccd"><?php echo $nv['luongcoban']; ?></div>
                            <label>Hệ số lượng</label>
                            <div id="hesoluong" class="blockcccd"><?php echo $nv['hesoluong']; ?></div>
                            <label>Học vấn</label>
                            <div id="hocvan" class="blockcccd"><?php echo $nv['hocvan']; ?></div>
                            <label>Công tác</label>
                            <div id="congtac" class="blockcccd"><?php echo $nv['congtac']; ?></div>
                        </div>
                        <div class="col-sm-4">
                            <img src="<?php echo $nv['anh']; ?>" id="imgnv" style="width: 100%;">
                            <label>Email</label>
                            <div id="email" class="blockcccd"><?php echo $nv['email']; ?></div>
                            <label>Số điện thoại</label>
                            <div id="sdt" class="blockcccd"><?php echo $nv['sdt']; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    function checkChangePass(){
        if(document.getElementById("newpass").value != document.getElementById("renewpass").value){
            alert("Mật khẩu mới không khớp!");
            return false;
        }
        return true;
    }
    var uls = new URL(document.URL)
    var errorpass = uls.searchParams.get("errorpass");
    var successPass = uls.searchParams.get("successPass");
    var updateinfor = uls.searchParams.get("updateinfor");
    if(errorpass =='true'){
        toastr.error("Mật khẩu cũ không đúng!");
    }
    if(successPass =='true'){
        toastr.success("Đổi mật khẩu thành công!");
    }
    if(updateinfor =='success'){
        toastr.success("Cập nhật thông tin thành công!");
    }
    if (performance.navigation.type == performance.navigation.TYPE_RELOAD) {
        window.location.href = 'taikhoan#'+ window.location.hash.substr(1);
    }
    
    function formatmoney(money) {
    const VND = new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND',
    });
    return VND.format(money);
}   
document.getElementById("selecthonnhan").value = document.getElementById("honnhan").value
var st = document.getElementsByClassName("sotiencl");
for(i=0; i<st.length; i++){
    st[i].innerHTML = formatmoney(st[i].textContent);

}
</script>
<script>
    function changeLink(e, link) {
        var tabs = document.getElementsByClassName("tabdv");
        for (i = 0; i < tabs.length; i++) {
            document.getElementsByClassName("tabdv")[i].classList.remove("activetabdv");
        }
        e.classList.add('activetabdv')

        var tabb = document.getElementsByClassName("tab-pane");
        for (i = 0; i < tabb.length; i++) {
            document.getElementsByClassName("tab-pane")[i].classList.remove("active");
        }
        document.getElementById(link).classList.add('active')
    }

    var hash = location.hash.substr(1);
    if (hash != "") {
        var tabb = document.getElementsByClassName("tab-pane");
        for (i = 0; i < tabb.length; i++) {
            document.getElementsByClassName("tab-pane")[i].classList.remove("active");
        }
        var tabs = document.getElementsByClassName("tabdv");
        for (i = 0; i < tabs.length; i++) {
            document.getElementsByClassName("tabdv")[i].classList.remove("activetabdv");
        }
        document.getElementById(hash).classList.add('active')
    }
</script>
<script>
    window.onload = function(){
        var TodayDate = new Date();
        var m = TodayDate.getMonth()+1;

    }
</script>
<style>
.tableluong {
  display: block;
  max-width: -moz-fit-content;
  max-width: fit-content;
  margin: 0 auto;
  overflow-x: auto;
  white-space: nowrap;
  height: 200px;
}
.sticky-col {
    position: sticky !important;
    position: -webkit-sticky;
    width: 100px !important;
    min-width: 100px !important;
    max-width: 100px !important;
    right: 0px !important;
    z-index: 1000 !important;
    background-color: #fff !important;
}
</style>
</html>