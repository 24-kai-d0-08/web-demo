<?php
    function ShowInfo($data,$stt,$max)
    { 
        while($row=mysqli_fetch_array($data))
        {
            $stt++;
            $dsanh=explode('|',$row['anhsanpham']);
            if($stt<=$max) 
            {
               echo'<div class="sanpham">
                    <div class="boxanhsp">
                        <a href="chitietsanpham.php?id='.$row['id'].'">
                        <img class="anhsp" src="file_img/'.$dsanh[0].'"></a>
                    </div>
                    <h5>'.$row['tensanpham'].'</h5>
                    <p>Giá sản phẩm:'.$row['giamoi'].'
                        <button class="iconM" name="'.$row['id'].'"><img class="muaicon" src="file_img/mua.png"></button>
                    </p>';
                     echo'</div>'; 
            }              
        }
    }
?>