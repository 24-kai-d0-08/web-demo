<?php 
session_start();
$_SESSION['giohang']=array_unique($_SESSION['giohang']);
?>
    <p class="dong"><img src="file_img/delete.png"></p>
    <h1>Danh sách mua</h1>
    <script>
        $('.dong').click(function(){
            $('.dsach-mua').removeClass('hien-giohang');   
        });
    </script>
    <?php
    include "Admin/connect.php"; 
    if(isset($_SESSION['giohang']))
    {
        if(isset($_POST['giohang']))
        {
            $_SESSION['giohang'][]=$_POST['giohang'];
        }
    }
    $list_id=implode(',',$_SESSION['giohang']);
    $query='SELECT * FROM `sanpham` WHERE `id`IN('.$list_id.')';   
    $data=mysqli_query($connect,$query);
    while($row=mysqli_fetch_array($data))
    {  
        $anh1=explode('|',$row['anhsanpham']);
        $anh=$anh1[0];
        echo'
        <div class="sanpham-mua">
            <div class="giotrai">
                <h3>Ten san pham:'.$row['tensanpham'].'</h3>
                <h3>Giá sản phẩm:'.$row['giamoi'].'</h3>
            </div>
            <div class="giophai">
                <img src="file_img/'.$anh.'">
            </div>
        </div>';
    }
    ?>
    <center>
        <a href="thanhtoan.php">
            <button class="nut-thanhtoan">Thanh toán</button>
        </a>
    </center>                    
        
