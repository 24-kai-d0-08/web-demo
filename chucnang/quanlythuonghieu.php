<?php
include 'connect.php';
if(isset($_FILES['logo'] )&& $_FILES['logo']['size']>0)
{
    echo '<pre>';
    print_r($_FILES['logo']);
    echo '<pre>';
    $nguon=$_FILES['logo']['tmp_name'];
    $dich='../file_img/'.$_FILES['logo']['name'];
    $update='file_img/'.$_FILES['logo']['name'];
    $query='UPDATE `logo` SET `link`="'.$update.'" WHERE 1';
    mysqli_query($connect,$query);
    if(move_uploaded_file($nguon,$dich))
    {
        echo 'thanh cong';
    }
    
}
if(isset($_POST['logo']))
{
    $query='UPDATE `logo` SET `thuonghieu`="'.$_POST['logo'].'" WHERE 1';
    mysqli_query($connect,$query);
}

?>
<form method="post" action="index.php?page=quanlythuonghieu" enctype="multipart/form-data">
<h3>Quản lý thương hiệu</h3>
<p> Thay đổi Logo:</p>
<input type="file" name="logo">
<input type="submit" value="Đăng tải">
<p> Thay đổi Thương hiệu:</p>
<input type="text" name="logo">
<input type="submit" value="Thay đổi">
</form>
<?php
    $slsp_moi=0;
    $slsp_hot=0;
    if(isset($_POST['slsp_hot'])&&$_POST['slsp_hot']>0)
    {
        $query='UPDATE `settingtrangweb` SET `slsp_hot`='.$_POST['slsp_hot'].' WHERE 1';
        mysqli_query($connect,$query);
    }
    if(isset($_POST['slsp_moi'])&&$_POST['slsp_moi']>0)
    {
        $query='UPDATE `settingtrangweb` SET `slsp_moi`='.$_POST['slsp_moi'].' WHERE 1';
        mysqli_query($connect,$query);
    }
    $query='SELECT * FROM `settingtrangweb` WHERE 1';
    $data=mysqli_query($connect,$query);
    while($row=mysqli_fetch_array($data))
    {
        $slsp_moi=$row['slsp_moi'];
        $slsp_hot=$row['slsp_hot'];
    }
    echo '<form action="index.php?page=quanlythuonghieu" method="post">
            <p>Hiển thị số lượng sản phẩm hot:
                <input type="text" name="slsp_hot" value="'.$slsp_hot.'">
            </p>
            <p>Hiển thị số lượng sản phẩm mới
                <input type="text" name="slsp_moi" value="'.$slsp_moi.'">
            </p>
            <input type="submit" value="Thay đổi">
         </form>';
?>

