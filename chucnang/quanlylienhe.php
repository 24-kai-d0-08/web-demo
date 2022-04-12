<?php
echo 
    '<h3>Quản lý liên hệ</h3>
        <form action="index.php?page=quanlylienhe" method="post">' ;        
        echo '<p>
                <div class="tieudelienhe">Thêm số điện thoại :</div>
                <input type="text" name="sdtthem">
                </p>';
    if(isset($_POST['email']))
    {
        $query='UPDATE `contact` SET `noidung`="'.$_POST['email'].'" WHERE `tieude`="email" ';
        mysqli_query($db_handle,$query);
    }
    if(isset($_POST['sdtthem']))   
    {
        $query='INSERT INTO `contact`(`id`, `tieude`, `noidung`) VALUES ("'.time().'","sdt","'.$_POST['sdtthem'].'")';
        mysqli_query($db_handle,$query);
    }
    $query='SELECT * FROM `contact` WHERE 1';
    $data=mysqli_query($connect,$query);
        while($row = mysqli_fetch_array($data))  
        {
            
            if($row['tieude']=='sdt')
            {
                $sdt[]=$row['noidung'];
                $dem++;
                echo '<p>
                <div class="tieudelienhe"> Số điện thoại liên hệ '.$dem.':</div>
                <input type="text" value="'.$row['noidung'].'" name="sdt'.$row['id'].'">
                <input type="hidden" name="xoa" value="'.$row['id'].'">
                <button>
                <a href="suasdt.php?sua='.$row['id'].'&sdt='.$row['noidung'].'">Sửa sđt</a>
                </button>
                <button>
                    <a href="xoasdt.php?xoa='.$row['id'].'">Xóa sđt</a>
                </button>
                </p>';   
            } 
            if($row['tieude']=='email')
            {
                echo '      
            <p>
                <div class="tieudelienhe">Email liên hệ:</div>
                <input type="email" value="'.$row['noidung'].'" name="email">
            </p> 
            <input type="submit" value="Xác nhận">
        </form>';
                $email=$row['noidung'];
            }
        
        } 

if($_GET['page']=='quanlythuonghieu')
{
        echo '<h3>Quản lý thương hiệu</h3>
                <form action="index.php" method="post" enctype="multipart/form-data">
                    <p>
                        <div class="tieudelienhe">
                            Thay đổi logo:
                        </div>
                        <input type="file" name="anh">
                    </p>
                    <p>
                        <div class="tieudelienhe">
                            Thay đổi thương hiệu:
                        </div>
                        <input type="text" name="thuonghieu">
                    </p>
                    <p><input type="submit" value="Xác nhận thay đổi"></p>
                    
                </form>';
}
?>