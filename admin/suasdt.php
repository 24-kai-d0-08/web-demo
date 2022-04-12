<?php
$db_handle = mysqli_connect('localhost','root','','webbanhang');
$query='SELECT * FROM `contact` WHERE 1';
$data=mysqli_query($db_handle,$query);
    if(isset($_GET['sua']) && isset($_GET['sdt']))
    {
        echo '<center>';
        echo '<form method="post" action="suasdt.php?sua='.$_GET['sua'].'&sdt='.$_GET['sdt'].'">
        <input type="text" name="sdt" value="'.$_GET['sdt'].'">
        <input type="submit" value="Sửa sđt">
        </form>';
        if(isset($_POST['sdt']))
        {
            while($row = mysqli_fetch_array($data))
            {
                if($row['id']==$_GET['sua'])
                {
                    $query='UPDATE `contact` SET `noidung`="'.$_POST['sdt'].'" WHERE `id`="'.$_GET['sua'].'"';
                    mysqli_query($db_handle,$query);
                    echo 'Đã sửa thành công số điện thoại,<a href="index.php?page=quanlylienhe">Bấm vào đây để quay lại</a>';
                }
            }
        }
        echo '</center>';
    }
?>