$(document).ready(function() {
    var main = '';
    for(i=1; i<=12; i++){ //Show ra popup12 tháng để chọn
        main += `<option value="${i}">Tháng ${i}</option>`
    }
    document.getElementById("month").innerHTML = main;

    var mainyear = '';
    for(i=2023; i<=2030; i++){// Show ra năm đẻ chọn
        mainyear += `<option value="${i}">năm ${i}</option>`
    }
    document.getElementById("year").innerHTML = mainyear;
});


async function taoThangLuong() {
    var month = document.getElementById("month").value; // Lấy DL tháng
    var year = document.getElementById("year").value;// Lấy DL năm
    var soNgayTrongThang = daysInMonth(month,year); // Lấy số ngày trong tháng
    var listDay = [];
    for(i=1; i<= soNgayTrongThang; i++){
        // yyyy-MM-dd : 2023-12-08
        var thu = getDayOfWeek(year+"-"+month+"-"+i);
        var obj = {
            "thu":thu,
            "ngay":i,
            "thang":month,
            "nam":year,
            "day":year+"-"+month+"-"+i
        }
        listDay.push(obj);
    }
    console.log(listDay); // Hiện thị ngày trong tháng
    // return;
    //Gọi api chấm công json
    var url = 'http://localhost:81/qlns/admin/services/chamcongjson?thang='+month+'&nam='+year;
    const response = await fetch(url, {
        method: 'POST',
        headers: new Headers({
            'Content-Type': 'application/json'
        }),
        body: JSON.stringify(listDay)
    });
    if (response.status < 300) {
        toastr.success("Thành công");
    }
    else{
        toastr.error("Lỗi");
    }
}

// Đếm ngày trong tháng
function daysInMonth (month, year) { // Truyền vào tháng, năm thì trả về số ngày trong tháng
    return new Date(year, month, 0).getDate();
}

function getDayOfWeek(date) {
    const dayOfWeek = new Date(date).getDay();    
    return isNaN(dayOfWeek) ? null : 
      ['Chủ nhật', 'Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7'][dayOfWeek];
}

var currentday = new Date();
var dds = String(currentday.getDate()).padStart(2, '0');
var mms = String(currentday.getMonth() + 1).padStart(2, '0');
var yyyys = currentday.getFullYear();

currentday = yyyys + '-' + mms + '-' + dds;

async function loadChamCong() { //Gọi tháng, năm thực hiện hàm createTable
    var month = document.getElementById("month").value;
    var year = document.getElementById("year").value;
    createTable(month, year);
    listId = [];
    //Thực hiện Api responsechamcong
    var url = 'http://localhost:81/qlns/admin/services/responsechamcong?month=' + month+'&year='+year;
    const response = await fetch(url, {
        method: 'GET'
    });
    console.log(response.status);
    if(response.status == 417){
        toastr.warning("Tháng này chưa tạo bảng chấm công");
        return;
    }
    var list = await response.json();
    var urlemp = 'http://localhost:81/qlns/admin/services/nhanvienjson?allemp=true';
    const res = await fetch(urlemp, {
    });
    var listemp = await res.json();
    console.log(list);
    console.log(listemp);
    var main = ''
    for(i=0; i<listemp.length; i++){ //Load ds nhân viên
        main += `<tr>`;
        main += `<td>${i+1}</td>
        <td>${listemp[i].id}</td>
        <td>${listemp[i].tennv}</td>
        `;
        var songaycong = 0;
        var songaynghi = 0;
        var songaynua = 0;
        //Thực hiện chấm công
        for(j=0; j<list.length; j++){  //Ktra mã nv trùng với id nv của bảng chấm công thì gộp cột lại
            if(list[j].nhanvien_id == listemp[i].id){
                if(list[j].thu != "Chủ nhật"){
                if(currentday == list[j].full_date){// Ktra xem ngày ngày chấm công là ngày hiện tại thì cho phép cập nhật dl
                        main += `<td style="background-color:lightgray"><input onkeyup="updateThongTin(${list[j].id})" id="sa${list[j].id}" class="inptable" value="${list[j].so_cong==null?'':list[j].so_cong}"></td>`;
                        listId.push(list[j].id);
                       
                    }
                    else{
                       main += `<td>${list[j].so_cong==null?'':list[j].so_cong}</td>`;
                    }
                }
                else{
                    main += `<td style="background-color:#ecf1af"></td>` //Hiển thị CN 
                }
                songaycong = Number(songaycong) + Number(list[j].so_cong);
                if(list[j].so_cong == 0){ //In ra số ngày nghỉ
                    ++songaynghi;
                }
                if(list[j].so_cong == 0.5){ //In ra số ngày nửa buổi
                    ++songaynua;
                }
            }
        }
        main += `<td style="background-color: #fff308 !important;" class="sticky-col">${songaycong}</td><td>${songaynghi}</td><td>${songaynua}</td>`
        main += `</tr>`;
    }
    document.getElementById("listnv").innerHTML = main;
}

function createTable(month, year){ 
    var numday = daysInMonth(month, year); //Tính số ngày trong tháng
    //In ra bảng chấm công
    var main = `<tr>
    <td rowspan="2">STT</td>
    <td rowspan="2">Mã NV</td>
    <td rowspan="2">Họ tên</td>`;
    for(i=1; i<= numday ; i++){
        main += `<td>${i}</td>`
    }
    main += `
    <td rowspan="2" style="background-color: #fff308 !important;" class="sticky-col">Số ngày công</td>
    <td rowspan="2">Số ngày nghỉ</td>
    <td rowspan="2">Sống ngày làm 1/2</td>`;
    main += `</tr>`;
    main += '<tr>'
    for(i=1; i<= numday ; i++){
        var thu = getDayOfWeek(year+"-"+month+"-"+i);
        var sty = '';
        if(thu == "Chủ nhật"){
            sty = `style="background-color:#ecf1af"`;
        }
        main += `<td ${sty}><span class="thucol inline">${thu}</span></td>`
    }
    main += '</tr>'
    document.getElementById("theadre").innerHTML = main;
}

var listId = [];
async function updateThongTin(id){
    var giatri = document.getElementById("sa"+id).value
    if(giatri != 0 && giatri != 1 && giatri != 0.5){
        document.getElementById("sa"+id).style.border = "2px solid red";
        return;
    }
    else{
        document.getElementById("sa"+id).style.border = "";
    }
    var url = 'http://localhost:81/qlns/admin/services/updatechamcong?id=' + id+'&giatri='+giatri;
    const response = await fetch(url, {
        method: 'GET'
    });
}

