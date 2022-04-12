<?php
session_start();
if(isset($_POST['soluong'])&&isset($_POST['sanpham']))
{
    $_SESSION['soluong']=$_POST['sanpham'].'|'.$_POST['soluong'];
}     
?>
<html>
<head>
    <meta charset='utf-8'>
    <title>Thông tin khách hàng</title>
    <link rel='stylesheet' type='text/css' href='style/style.css'>
    <link rel='stylesheet' type='text/css' href='style/bootstrap-5.0.2/css/bootstrap.min.css'>
    <script src='style/bootstrap-5.0.2/js/bootstrap.min.js'></script>
    <meta name='viewport' content='width=divice-width,initial-scale=1'>
    <script src='style/jquery-3.6.0.min.js'></script>
</head>
<body>
    <div class="body">
        <header>    
            <div class='header'>
            <?php
                    include 'header.php';
            ?>
            </div>      
        </header>
        <div class='clear'>   
        </div>
        <center><h2 class="thongtin-kh">Thông tin người mua</h2></center>   
        <?php
            if(isset($_POST['ten'])&&isset($_POST['sdt'])&&isset($_POST['address'])&&isset($_POST['email'])&&isset($_POST['check']))
            /*echo'<p><span class="chitiet-kh">Tên: </span>'.$_POST['ten'].'</p>
            <p> <span class="chitiet-kh">Địa chỉ: </span>'.$_POST['sdt'].'</p>
            <p> <span class="chitiet-kh">Số điện thoại: </span>'.$_POST['address'].'</p>
            <p> <span class="chitiet-kh">Email: </span>'.$_POST['email'].'</p>';*/
            {
                include 'admin/connect.php';
                $query='INSERT INTO `thongtinkhachhang`(`ten`, `sdt`, `diachi`, `email`, `donhang`)
                        VALUES ("'.$_POST['ten'].'","'.$_POST['sdt'].'","'.$_POST['address'].'","'.$_POST['email'].'","'.$_SESSION['don-hang'].'")';
                mysqli_query($connect,$query);
                

            }
        ?>

    <center><p style="color:red;padding-bottom:60px">Cảm ơn quý khách đã lựa chọn sản phẩm của chúng tôi</p></center>
    </div>
    <div class='clear'>   
    </div>
    <footer>
        <h3>~Luôn đảm bảo chất lượng và giá cả~</h3>
        <p>@2021 copyright: Đỗ văn Vượng</p>
    </footer>
</body>
</html>