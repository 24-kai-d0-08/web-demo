<html>
<head>
    <meta charset='utf-8'>
    <title>Đăng nhập</title>
    <link rel='stylesheet' type='text/css' href='../style/admin.css'>
    <meta name='viewport' content='width=divice-width,initial-scale=1'>
</head>
<body>
    <form action="login.php" method="post" class="login">
        <div class="dangnhap">
            <h1>Đăng nhập</h1>
            <?php
                session_start();
                if(isset($_SESSION['doimk']))
                {
                    echo '<p class="error">Đổi mật khẩu thành công</p>';
                }
                if(isset($_POST['tk'])&&isset($_POST['mk']))
                {
                    include 'connect.php';
                    $query='SELECT `taikhoan`, `matkhau` FROM `login` WHERE 1';
                    $data=mysqli_query($connect,$query);
                    while($row=mysqli_fetch_array($data))
                    {
                        if($row[0]==md5($_POST['tk']) && $row[1]==md5($_POST['mk']))
                        {
                            $_SESSION['loginwebbanhang']=time();
                            if(isset($_SESSION['doimk']))
                            {
                                unset($_SESSION['doimk']);
                            }
                            header("location:index.php");
                        }
                        else{
                            echo '<p class="error">Thông tin đăng nhập không chính xác</p>';
                        }
                    }
                }
            ?>
            <input type="text" name="tk" placeholder="Nhập tài khoản" class="ologin">
            <input type="password" name="mk" placeholder="Nhập mật khẩu" class="ologin">
            <center>
            <input type="submit" value="Đăng nhập" class="nutdn">
            </center> 
        </div>
    </form>
</body>
</html>