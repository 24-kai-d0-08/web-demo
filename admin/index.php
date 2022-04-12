<html>
<head>
    <meta charset='utf-8'>
    <title>Quản Lý</title>
    <link rel='stylesheet' type='text/css' href='../style/admin.css'>
    <meta name='viewport' content='width=divice-width,initial-scale=1'>
</head>
<body>
    <div class='top'>
        <div class='user'>
            <p id='trangchu'><a href="../index.php">Trang chủ</a></p>
            <p class='taikhoan'><a href="dangxuat.php">Đăng Xuất</a> </p>
            <p class='taikhoan'><a href="doimk.php">Đổi mật khẩu</a> </p>
        </div>
        <div class='title'>
            <h1>Trang quản trị</h1>
        </div>
    </div>
    <div class='left'>
        <ul class='menu'>
            <li>
                <a href="index.php?page=quanlylienhe">Quản lý liên hệ</a>
            </li>
            <li>
                <a href="index.php?page=quanlythuonghieu">Quản lý thương hiệu</a> 
            </li>
            <li>
                <a href="index.php?page=quanlymenu">Quản lý Menu</a> 
            </li>
            <li>
                <a href="index.php?page=quanlysanpham">Quản lý sản phẩm</a> 
            </li>
            <li>
                <a href="index.php?page=quanlyfooter">Quản lý footer</a> 
            </li>
            <li>
                <a href="index.php?page=quanlyslide">Quản lý slide</a> 
            </li>
        </ul>
    </div>
    <div class='right'>
        <?php
        session_start();
        $timeout=time();
        if(!isset($_SESSION['loginwebbanhang']))
        {
            header('location:login.php');
        }
        if(isset($_SESSION['loginwebbanhang']))
        {
            if($timeout-$_SESSION['loginwebbanhang']>6000)
            {
                unset($_SESSION['loginwebbanhang']);
                header('location:login.php');
            }
        }
         include 'connect.php';
         $dem=0;
         $email='';
         $sdt=array();
            if(isset($_GET['page']))
            {
                if($_GET['page']=='quanlylienhe')
                {
                    include '../chucnang/quanlylienhe.php';
                }
                if($_GET['page']=='quanlythuonghieu')
                {
                    include '../chucnang/quanlythuonghieu.php';
                } 
                if($_GET['page']=='quanlymenu')
                {
                    include '../chucnang/quanlymenu.php';
                } 
                if($_GET['page']=='quanlysanpham')
                {
                    include '../chucnang/quanlysanpham.php';
                }
                if($_GET['page']=='quanlyfooter')
                {
                    include '../chucnang/quanlyfooter.php';
                }
                if($_GET['page']=='quanlyslide')
                {
                    include '../chucnang/quanlyslide.php';
                }
            }    
        ?>   
    </div>
</body>
</html>