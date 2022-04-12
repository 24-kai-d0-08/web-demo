<?php
$db_handle = mysqli_connect('localhost','root','','webbanhang');
$query='SELECT * FROM `contact` WHERE 1';
$data=mysqli_query($db_handle,$query);
    if(isset($_GET['xoa']))
    {
        while($row = mysqli_fetch_array($data))
        {
            if($row['id']==$_GET['xoa'])
            {
                $query='DELETE FROM `contact` WHERE `id`= '.$_GET['xoa'];
                mysqli_query($db_handle,$query);
                echo 'Đã xóa thành công số điện thoại,<a href="index.php?page=quanlylienhe">Bấm vào đây để quay lại</a>';
            }
        }
    }
?>