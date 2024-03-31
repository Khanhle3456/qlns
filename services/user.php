<?php
    require_once('database/connect.php');
    // $pass = md5('admin');
    // $sql = "insert into users(username, password, quyen) values('admin', '$pass','ROLE_ADMIN')";
    // execute($sql);
    function login(){
       $email = $_POST['email'];
       $password = md5($_POST['password']);
       $sql = "select u.*,(select n.anh from nhanvien n where n.user_id = u.id) as anh from users u where u.username = '${email}' and u.password = '${password}' and trangthai = 1";
       $result = executeresult($sql);
       if(sizeof($result) > 0){
            $user = $result[0];
            $_SESSION['user'] = $user;
            if($user['quyen'] == "ROLE_ADMIN"){
                header('location: admin/taikhoan');
            }
            else{
                header('location: taikhoan');
            }
       }
       else{
            header('Location:index?error=true');
       }
    }

    function changePassword() {
        $oldpass = $_POST['oldpass'];
        $newpass = $_POST['newpass'];
        if(md5($oldpass) != $_SESSION['user']['password']){
            header('location:taikhoan?errorpass=true#changepass');
        }
        else{
            $newp = md5($newpass);
            $id = $_SESSION['user']['id'];
            $sql = "update users set password = '$newp' where id = $id";  
            execute($sql);
            $sql = "select u.*,(select n.anh from nhanvien n where n.user_id = u.id) as anh from users u where u.id = $id";
            $result = executeresult($sql);
            unset($_SESSION['user']);
            $_SESSION['user'] = $result[0];
            header('location:taikhoan?successPass=true#changepass');
        }

    }

?>