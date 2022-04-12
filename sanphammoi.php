<div class='blog'>
    <div class='thongbao'>
            <h5>Sản phẩm mới</h5>
    </div>
    <?php
        include "Admin/connect.php";
        $slsptranghienthi1=8;
        $query='SELECT  `slsp_moi` FROM `settingtrangweb` WHERE 1';      
        $data=mysqli_query($connect,$query);
        while($row=mysqli_fetch_array($data))
        {  
            $slsptranghienthi1=$row['slsp_moi'];
        }  
        $query1='SELECT * FROM `sanpham` WHERE 1 ORDER BY `id` DESC';
        $data1=mysqli_query($connect,$query1);
        $stt1=0;
        ShowInfo($data1,$stt1,$slsptranghienthi1);  
    ?>
    <div class="dsach-mua">
    </div>
    <!--<a href="?id='.$row['id'].'"><button class="iconM"><img class="muaicon" src="file_img/mua.png"></button></a>-->