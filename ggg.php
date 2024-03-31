<?php 
        $result = getAllChamCong();
        $i = 0;
        foreach($result as $re){ 
        $songaylam = $re['songaycong']==null?0:$re['songaycong'];
        $bhxh = $re['luongcoban']*8/100;
        $bhyt = $re['luongcoban']*1.5/100;
        $bhtn = $re['luongcoban']*1/100;
        $tongthuong = $re['tongthuong']==null?0:$re['tongthuong'];
        $tongphat = $re['tongphat']==null?0:$re['tongphat'];
        $tongtru = $bhxh + $bhyt + $bhtn;
        $tongluong=0 ;
        if($songaylam > 0){
            $tongluong = $re['luongcoban']/ 26* $songaylam*$re['hesoluong']+$tongthuong-$tongphat-$tongtru;
        }
    ?>
    <tr>
        <td><?php echo ++$i; ?></td>
        <td><?php echo $re['id']; ?></td>
        <td><?php echo $re['tennv']; ?></td>
        <td><?php echo $re['tenpb']; ?></td>
        <td><?php echo $re['chucvu']; ?></td>
        <td><?php echo $songaylam ?></td>
        <td class="sotiencl"><?php echo $re['luongcoban']; ?></td>
        <td class="sotiencl"><?php echo $tongthuong ?></td>
        <td class="sotiencl"><?php echo $tongphat ?></td>
        <td><?php echo $re['hesoluong']; ?></td>
        <td class="sotiencl"><?php echo $bhxh ?></td>
        <td class="sotiencl"><?php echo $bhyt ?></td>
        <td class="sotiencl"><?php echo $bhtn ?></td>
        <td class="sotiencl"><?php echo $tongtru ?></td>
        <td style="background-color: #fff308 !important;" class="sotiencl sticky-col"><?php echo $tongluong ?></td>
    </tr>