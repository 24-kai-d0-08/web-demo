<?php
if(isset($_FILES['slide'] )&& $_FILES['slide']['size']>0 && isset($_POST['tieude']))
{
    include '../admin/connect.php';
    $nguon=$_FILES['slide']['tmp_name'];
    $dich='../file_img/'.$_FILES['slide']['name'];
    $update='file_img/'.$_FILES['slide']['name'];
    $query='INSERT INTO `slide`(`tenanh`, `tieude`) VALUES ("'.$_FILES['slide']['name'].'","'.$_POST['tieude'].'")';
    mysqli_query($connect,$query);
    if(move_uploaded_file($nguon,$dich))
    {
        header("location:../admin/index.php?page=quanlyslide");
    }  
}
else 
include 'connect.php';
?>
<h3>Quản lý Slide</h3>
<?php
    $query='SELECT * FROM `slide` WHERE 1';
    $data=mysqli_query($connect,$query);
    while($row=mysqli_fetch_array($data))
    {
        echo'
        <hr>
        <p>
            <h4>Thay đổi tiêu đề:</h4>
                <form action="quanlyslide.php" method="post">
                    <input type="text" value="'.$row["tieude"].'">
                    <input type="submit" value="Sửa"> 
                </form>
            <img style="width:300px;" src="../file_img/'.$row["tenanh"].'" alt="">
        </p>
        <a href="../chucnang/xoaslide.php?xoa='.$row["id"].'">Xóa ảnh này</a> 
        ';
    }
?>

<p>
    Thêm slide:
</p>
<form action="../chucnang/quanlyslide.php" method="post" enctype="multipart/form-data">
    <input type="file" name="slide" >
    <input type="text" name="tieude" placeholder="Nhập tiêu đề slide">
    <input type="submit" value="Upload">
</form>