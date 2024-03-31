<?php
function getAllPhongBan(){
    $sql = "select * from phongban";
    $result = executeresult($sql);
    $main = "";
    foreach ($result as $re) {
        $ac = '';
        if(isset($_GET['mapb'])){
            if($_GET['mapb'] == $re['ma_pb']){
                $ac = 'activeMedia';
            }
        }
        $main .= '<div class="media-29101 '.$ac.'">
        <a href="?mapb='.$re['ma_pb'].'"><img src="'.$re['anh'].'" class="img-fluid"></a>
        <h3><a href="#">'.$re['ten'].'</a></h3>
    </div>';
    }
    return $main;
}
?>