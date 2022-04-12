<div class='blog'>
    <div class='thongbao'>
            <h5>Sản phẩm Hot</h5>
    </div>
    <?php
        include "Admin/connect.php";
        $slsptranghienthi=8;
        $query='SELECT  `slsp_hot` FROM `settingtrangweb` WHERE 1';      
        $data=mysqli_query($connect,$query);
        while($row=mysqli_fetch_array($data))
        {  
            $slsptranghienthi=$row['slsp_hot'];
        }
        $query='SELECT * FROM `sanpham` WHERE 1 ORDER BY `sldaban` DESC';
        $data=mysqli_query($connect,$query);
        $stt=0;
        ShowInfo($data,$stt,$slsptranghienthi);
    ?>
    <div class="dsach-mua">
    </div>
    