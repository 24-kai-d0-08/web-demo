<?php
if(isset($_POST['page']))
{
    include "../admin/connect.php";
    $query='UPDATE `settingtrangweb` SET `phantrangadmin`='.$_POST['page'].' WHERE 1';
    if(mysqli_query($connect,$query))
    {
        header('location:../admin/index.php?page=quanlysanpham');
    }   
}
?>