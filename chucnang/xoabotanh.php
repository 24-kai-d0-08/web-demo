<?php
if(isset($_GET['sanpham'])&&isset($_GET['anh']))
{
    include "../admin/connect.php";
    $query='SELECT * FROM `sanpham` WHERE `id`='.$_GET['sanpham'];
    $data=mysqli_query($connect,$query);
    $anhsanphammoi='';
    while($row=mysqli_fetch_array($data))
    {
        $anh=explode("|",$row['anhsanpham']);
        foreach($anh as $key => $value)
        {
            if($value==$_GET['anh'])
            {
                unset($anh[$key]);
            }
        }
        $anhsanphammoi=implode("|",$anh);
    }
    $query='UPDATE `sanpham` SET `anhsanpham`="'.$anhsanphammoi.'" WHERE `id`='.$_GET['sanpham'];
    if(mysqli_query($connect,$query))
    {
        header("location:suasanpham.php?sua=".$_GET['sanpham']);
    }
}
?>