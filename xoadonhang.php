<?php
    session_start();
    if(isset($_GET['spxoa']))
    {
        echo '<center>Bạn có muốn xóa sản phẩm này không?
        <a href="xoadonhang.php?xoa='.$_GET['spxoa'].'">Xóa sản phẩm</a>
        <a href="thanhtoan.php">Quay lại trang thanh toán</a></center>';
    }
    if(isset($_GET['xoa']))
    {
        if(isset($_SESSION['giohang']))
        {
            foreach($_SESSION['giohang'] as $key => $value )
            {
                if($value==$_GET['xoa'])
                {
                    unset($_SESSION['giohang'][$key]);
                    header('location:thanhtoan.php');
                }
            }
        }
    }
?>