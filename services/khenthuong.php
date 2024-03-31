<?php
    function loadKhenThuong(){
        $userid = $_SESSION['user']['id'];
        $sql = "select t.* from thuongphat t INNER join nhanvien n on n.id = t.nhanvien_id 
        where n.user_id = $userid";  
        $result = executeresult($sql);
        $main = "";
        foreach ($result as $re) {
            $loai = '<span class="phat">Phạt</span>';
            if($re['loai'] == 1){
                $loai = '<span class="thuong">Thưởng</span>';
            }
            $main .= '<tr>
            <td>'.$re['id'].'</td>
            <td>'.$re['tieude'].'</td>
            <td>'.$re['ngaytao'].'</td>
            <td class="sotiencl">'.$re['sotien'].'</td>
            <td>'.$loai.'</td>
            <td>'.$re['noidung'].'</td>
        </tr>';
        }
    return $main;
    }
?>