<html>
<head>
    <meta charset='utf-8'>
    <title>Thêm sản phẩm</title>
    <link rel='stylesheet' type='text/css' href='../style/admin.css'>
    <script src="../style/ckeditor/ckeditor.js"></script>
<body>
    <div class="thongtinsanpham">
    <h3>Thông tin về sản phẩm </h3>
    <?php
        include "../admin/connect.php";
        if(isset($_POST['tensanpham'])&&isset($_POST['danhmuc'])&&isset($_POST['chitietsanpham'])
        &&isset($_POST['gia'])&&isset($_GET['sua']))
        {
            $tensp=$_POST['tensanpham'];
            $danhmuc=$_POST['danhmuc'];
            $chitietsanpham=$_POST['chitietsanpham'];
            $giamoi=$_POST['gia'];
            $giacu='';
            $anhsanpham='';
            $query='SELECT * FROM `sanpham` WHERE `id`='.$_GET['sua'];
            $data=mysqli_query($connect,$query);
            $sldaban='';
            while($row=mysqli_fetch_array($data))
            {
                $anhsanpham=$row['anhsanpham'];
                $giacu=$row['giamoi'];
                $sldaban=$row['sldaban'];
            }
            foreach($_FILES['anhsanpham']['name']as $key =>$listimg){
                $array=explode('.',$listimg);
                $ext=end($array);
                $dsanh=array('jpg','png','gif','JPG','PNG','GIF');
                if(in_array($ext,$dsanh))
                {
                    $nguon=$_FILES['anhsanpham']['tmp_name'][$key];
                    $dich='../file_img/'.$listimg;
                    copy($nguon,$dich);  
                    $anhsanpham.='|'.$listimg;
                }
                else
                    echo 'File chọn không phù hợp';
            }
            
            $query='UPDATE `sanpham` SET `danhmuc`="'.$danhmuc.'",`tensanpham`="'.$tensp.'",`anhsanpham`="'.$anhsanpham.'",
            `thongtinsanpham`="'.$chitietsanpham.'",`giacu`="'.$giacu.'",`giamoi`="'.$giamoi.'",`sldaban`="'.$sldaban.'" WHERE `id`='.$_GET['sua'];
            if(mysqli_query($connect,$query))
            {
                header ('location:../admin/index.php?page=quanlysanpham');
            }
            
        } 
    ?>
    <?php
        if(isset($_GET['sua']))
        {
            $id=$_GET['sua'];
            $danhmuc='';
            $tensanpham='';
            $anhsanpham='';
            $thongtinsanpham='';
            $giacu='';
            $giamoi='';
            $sldaban='';
            $query='SELECT * FROM `sanpham` WHERE `id`='.$id;
            $data=mysqli_query($connect,$query);
            while($row=mysqli_fetch_array($data))
            {
                $danhmuc=$row['danhmuc'];
                $tensanpham=$row['tensanpham'];
                $anhsanpham=$row['anhsanpham'];
                $thongtinsanpham=$row['thongtinsanpham'];
                $giacu=$row['giacu'];
                $giamoi=$row['giamoi'];
                $sldaban=$row['sldaban'];
            }
            echo'<form action="suasanpham.php?sua='.$id.'" method="post" enctype="multipart/form-data">
                    <p>
                        <input class="tensanpham" type="text" name="tensanpham" value="'.$tensanpham.'">
                    </p>
                    <p> Danh Mục Sản Phẩm:
                    <select name="danhmuc" class="danhmuc">';
                    $query='SELECT `id`, `idcha`, `tenmenu` FROM `menu` WHERE `idcha`!=0';
                    $data=mysqli_query($connect,$query);
                    while($row=mysqli_fetch_array($data))
                    {
                        if($danhmuc==$row['id'])
                        {
                            echo '<option selected="selected" value="'.$row['id'].'">'.$row['tenmenu'].'</option>';
                        }
                        else
                            echo '<option value="'.$row['id'].'">'.$row['tenmenu'].'</option>';
                    }
                echo'</select>
                    </p>
                    <p>
                        <input class="gia" type="text" name="gia" value="'.$giamoi.'">
                    </p>
                    <p>Nhập thông tin sản phẩm<br>
                        <textarea name="chitietsanpham" id="chitietsanpham" rows="5">'.$thongtinsanpham.'</textarea>
                    </p>';  
                echo'<p>
                        <input type="file" name="anhsanpham[]" multiple>
                    </p>
                    <div class="vunganhsua">';
                    $anh=explode("|",$anhsanpham);
                    foreach($anh as $key => $value)
                    {
                        echo'<div class="boxanhsua">
                            <center>    
                                <a href="xoabotanh.php?sanpham='.$_GET['sua'].'&anh='.$value.'">
                                <img class="anhxoa" src="../file_img/delete.png">
                                </a>
                            </center> 
                                <img class="anhsua" src="../file_img/'.$value.'">
                            </div>';
                    }
                echo '</div>
                    <p>
                        <input type="submit" class="submit" value="Sửa">
                    </p>
                    
                </form>';
                
        }
    ?>
    <script>
        CKEDITOR.replace( 'chitietsanpham' );   
    </script>
    </div>
</body>
</html>