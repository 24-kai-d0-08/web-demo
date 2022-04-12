<html>
<head>
    <meta charset='utf-8'>
    <title>Thêm sản phẩm</title>
    <link rel='stylesheet' type='text/css' href='../style/admin.css'>
    <script src="../style/ckeditor/ckeditor.js"></script>
<body>
    <div class="thongtinsanpham">
    <h3>Thông tin về sản phẩm mới</h3>
    <?php
        include "connect.php";
        if(isset($_POST['tensanpham'])&&isset($_POST['danhmuc'])&&isset($_POST['chitietsanpham'])&&isset($_POST['gia'])&&isset($_FILES['anhsanpham']))
        {
            $tensp=$_POST['tensanpham'];
            $danhmuc=$_POST['danhmuc'];
            $chiteietsanpham=$_POST['chitietsanpham'];
            $gia=$_POST['gia'];
            $anhsanpham='';
            $check=0;
            foreach($_FILES['anhsanpham']['name']as $key =>$listimg){
                $array=explode('.',$listimg);
                $ext=end($array);
                $dsanh=array('jpg','png','gif','JPG','PNG','GIF');
                if(in_array($ext,$dsanh))
                {
                    $nguon=$_FILES['anhsanpham']['tmp_name'][$key];
                    $dich='../file_img/'.$listimg;
                    if(copy($nguon,$dich))
                    {
                        $check=1;
                    }   
                    if($anhsanpham=='')
                    {
                        $anhsanpham=$listimg;
                    }
                    else
                        $anhsanpham.='|'.$listimg;
                }
                else
                    echo 'File chọn không phù hợp';
            }
            if($check==1)
            {
                $query='INSERT INTO `sanpham`(`id`, `danhmuc`, `tensanpham`, `anhsanpham`, `thongtinsanpham`, `giacu`, `giamoi`)
                 VALUES("'.time().'","'.$danhmuc.'","'.$tensp.'","'.$anhsanpham.'","'.$chiteietsanpham.'","'.$gia.'","'.$gia.'")';
                if(mysqli_query($connect,$query))
                {
                    header ('location:index.php?page=quanlysanpham');
                }
            }
        }
        
    ?>
    <form action="themsanpham.php" method="post" enctype="multipart/form-data">
        <p>
            <input class="tensanpham" type="text" name="tensanpham" placeholder="Vui lòng nhập tên sản phẩm ở đây">
        </p>
        <p> Danh Mục Sản Phẩm:
            <select name="danhmuc" class="danhmuc">
                <?php
                    $query='SELECT `id`, `idcha`, `tenmenu` FROM `menu` WHERE `idcha`!=0';
                    $data=mysqli_query($connect,$query);
                    while($row=mysqli_fetch_array($data))
                    {
                        echo '<option value="'.$row['id'].'">'.$row['tenmenu'].'</option>';
                    }
                ?>
            </select>
        </p>
        <p>
            <input class="gia" type="text" name="gia" placeholder="Nhập giá sản phẩm">
        </p>
        <p>Nhập thông tin sản phẩm<br>
            <textarea name="chitietsanpham" id="chitietsanpham" rows="5"></textarea>
        </p>
        <p>
            <input type="file" name="anhsanpham[]" multiple>
        </p>
        <p>
            <input type="submit" class="submit" value="Đăng tải">
        </p>
        <script>
                CKEDITOR.replace( 'chitietsanpham' );   
            </script>
    </form>
    </div>
</body>
</html>