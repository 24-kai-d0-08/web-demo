<html>
<head>
    <meta charset='utf-8'>
    <title>Đổi mật khẩu</title>
    <link rel='stylesheet' type='text/css' href='../style/admin.css'>
    <meta name='viewport' content='width=divice-width,initial-scale=1'>
</head>
<body>
    <form action="doimk.php" method="post" class="login">
    <div class="dangnhap">
            <h1>Đổi mật khẩu</h1>
            <?php
                session_start();
                if(!isset($_SESSION['loginwebbanhang']))
                {
                    header("location:login.php");
                }
                if(isset($_POST['mk1'])&&isset($_POST['mk2'])&&isset($_POST['mk3']))
                {
                    include 'connect.php';
                    $query='SELECT `taikhoan`, `matkhau` FROM `login` WHERE 1';
                    $data=mysqli_query($connect,$query);
                    while($row=mysqli_fetch_array($data))
                    {
                        if($row[1]==md5($_POST['mk1']) && $_POST['mk2'] == $_POST['mk3'] &&$_POST['mk2']!=$_POST['mk1']))
                        {
                            $query='UPDATE `login` SET `matkhau`="'.md5($_POST['mk2']).'" WHERE 1';
                            if(mysqli_query($connect,$query))
                            {
                                $_SESSION['doimk']=1;
                                header("location:login.php");
                            }
                        }
                        else{
                            echo '<p class="error">Thông tin nhập vào không chính xác</p>';
                        }
                    }
                }
            ?>
            <input type="password" name="mk1" placeholder="Nhập mật khẩu cũ" class="ologin">
            <input type="password" name="mk2" placeholder="Nhập mật khẩu mới" class="ologin">
            <input type="password" name="mk3" placeholder="Nhập lại mật khẩu mới" class="ologin">
            <center>
            <input type="submit" value="Đổi mật khẩu" class="nutdn">
            </center> 
        </div>
    </form>
</body>
</html>