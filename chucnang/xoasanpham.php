<?php
if(isset($_GET['xoa']))
{
    if(isset($_GET['xacnhan']))
    {
        $query='DELETE FROM `sanpham` WHERE `id`='.$_GET['xoa'];
        include "../admin/connect.php";
        if(mysqli_query($connect,$query))
        {
            header('location:../admin/index.php?page=quanlysanpham');
        }
    }
    echo '<center>
         <p>ban co muon xoa san pham nay khong?</p>';
    echo '<a href="xoasanpham.php?xoa='.$_GET['xoa'].'&xacnhan=1"><button>xoa</button></a>';
    echo '&nbsp<a href="../admin/index.php?page=quanlysanpham"><button>quay lai</button></a>
         </center>';
}
?>

