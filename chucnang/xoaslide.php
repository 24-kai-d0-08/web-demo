<?php
    if(isset($_GET['xoa']))
    {
        if(isset($_GET['xacnhan']))
        {
            include '../admin/connect.php';
            $query='DELETE FROM `slide` WHERE `id`='.$_GET["xacnhan"];
            if(mysqli_query($connect,$query))
            {
                header('location:../admin/index.php?page=quanlyslide');
            }
        }
        
        echo'<center>
            Bạn có muốn xóa slide này không?
            <a href="xoaslide.php?xoa='.$_GET["xoa"].'&xacnhan=1">Xóa</a>
            <a href="../admin/index.php?page=quanlyslide">Quay lại</a>
        </center>';

    }
?>