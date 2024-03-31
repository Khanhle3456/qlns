<?php
    function loadUser(){
        $sql = "select * from users";
        if(isset($_GET['role'])){
            $role = $_GET['role'];
            $sql .= " where quyen='${role}'";
        }
        $result = executeresult($sql);
        $main = '';
        foreach($result as $re){
            $act = '<a href="?lock='.$re['id'].'" class="btn btn-primary">Khóa</a>';
            if($re['trangthai'] == 0){
                $act = '<a href="?unlock='.$re['id'].'" class="btn btn-danger">Mở khóa</a>';
            }
            if($re['quyen'] == "ROLE_ADMIN"){
                $act = ''; 
            }
            $main .= 
            '<tr>
                <td>'.$re['id'].'</td>
                <td>'.$re['username'].'</td>
                <td>'.$re['quyen'].'</td>
                <td class="sticky-col">'.$act.'</td>
            </tr>';
        } 
        return $main;
    }

    if(isset($_GET['lock'])){
        $id = $_GET['lock'];
        lockOrUnlock($id, 0);
    }
    if(isset($_GET['unlock'])){
        $id = $_GET['unlock'];
        lockOrUnlock($id, 1);
    }

    function lockOrUnlock($id, $trangthai){
        $sql = "update users set trangthai = $trangthai where id = '${id}'";
        execute($sql);
        echo "<script>
            window.location.href = 'taikhoan?success=1';
        </script>";
    }
?>