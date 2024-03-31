$(document).ready(function() {
    var main = '';
    for(i=1; i<=12; i++){//Show ra popup12 tháng để chọn
        main += `<option value="${i}">Tháng ${i}</option>`
    }
    document.getElementById("month").innerHTML = main;

    var mainyear = '';
    for(i=2023; i<=2030; i++){ // Show ra năm đẻ chọn
        mainyear += `<option value="${i}">năm ${i}</option>`
    }
    document.getElementById("year").innerHTML = mainyear;

    var TodayDate = new Date();
    var m = TodayDate.getMonth();
    var y = TodayDate.getFullYear();
    document.getElementById("month").value = m; // Lấy DL tháng
    document.getElementById("year").value = y;
    loadChamCong();
});



function daysInMonth (month, year) {
    return new Date(year, month, 0).getDate();
}

function getDayOfWeek(date) {
    const dayOfWeek = new Date(date).getDay();    
    return isNaN(dayOfWeek) ? null : 
      ['Chủ nhật', 'Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7'][dayOfWeek];
}


async function loadChamCong() {
    var month = document.getElementById("month").value;
    var year = document.getElementById("year").value;
    loadLuong(month, year);
    createTable(month, year);
    listId = [];
    var url = 'http://localhost:81/qlns/services/responsechamcong?month=' + month+'&year='+year;
    const response = await fetch(url, {
        method: 'GET'
    });
    console.log(response.status);
    if(response.status == 417){
        toastr.warning("Tháng này chưa tạo bảng chấm công");
        return;
    }
    var list = await response.json();
    console.log(list);
    var urlemp = 'http://localhost:81/qlns/services/nhanvienjson';
    const res = await fetch(urlemp, {
    });
    var listemp = await res.json();
    console.log(list);
    console.log(listemp);
    var main = ''
    for(i=0; i<listemp.length; i++){
        main += `<tr>`;
        main += `<td>${i+1}</td>
        <td>${listemp[i].id}</td>
        <td>${listemp[i].tennv}</td>
        `;
        var songaycong = 0;
        var songaynghi = 0;
        var songaynua = 0;
        for(j=0; j<list.length; j++){
            if(list[j].nhanvien_id == listemp[i].id){
                if(list[j].thu != "Chủ nhật"){
                    main += `<td>${list[j].so_cong==null?'x':list[j].so_cong}</td>`;
                    listId.push(list[j].id);
                   
                }
                else{
                    main += `<td style="background-color:#ecf1af"></td>`
                }
                songaycong = Number(songaycong) + Number(list[j].so_cong);
                if(list[j].so_cong == 0){
                    ++songaynghi;
                }
                if(list[j].so_cong == 0.5){
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
    var numday = daysInMonth(month, year);
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


async function loadLuong(month, year) {
    var url = 'http://localhost:81/qlns/services/chamcong?month=' + month+'&year='+year;
    const response = await fetch(url, {
        method: 'GET'
    });
    var list = await response.json();
    if(list.length > 0){
        var obj = list[0];
        console.log(obj);
        var tongthuong = obj.tongthuong==null?0:obj.tongthuong
        var tongphat = obj.tongphat==null?0:obj.tongphat;
        var songaylam = obj.songaycong==null?0:obj.songaycong;
        var bhxh = obj.luongcoban*8/100;
        var bhyt = obj.luongcoban*1.5/100;
        var bhtn = obj.luongcoban*1/100;
        var tongtru = bhxh + bhyt + bhtn;
        var tongluong=0 ;
        if(songaylam > 0){
            tongluong = obj.luongcoban/ 26* songaylam*obj.hesoluong+tongthuong-tongphat-tongtru;
        }
        var main = 
        `<tr>
            <td>1</td>
            <td>${obj.id}</td>
            <td>${obj.tennv}</td>
            <td>${obj.tenpb}</td>
            <td>${obj.chucvu}</td>
            <td>${songaylam}</td>
            <td>${formatmoney(obj.luongcoban)}</td>
            <td>${formatmoney(tongthuong)}</td>
            <td>${formatmoney(tongphat)}</td>
            <td>${obj.hesoluong}</td>
            <td>${formatmoney(bhxh)}</td>
            <td>${formatmoney(bhyt)}</td>
            <td>${formatmoney(bhtn)}</td>
            <td>${formatmoney(tongtru)}</td>
            <td style="background-color: #fff308 !important;" class="sotiencl sticky-col">${formatmoney(tongluong)}</td>
        </tr>`
        document.getElementById("tbodyluong").innerHTML = main;
    }
}

function formatmoney(money) {
    const VND = new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND',
    });
    return VND.format(money);
}

