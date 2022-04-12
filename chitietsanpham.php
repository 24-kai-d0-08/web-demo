<html>
<head>
    <meta charset='utf-8'>
    <title>Bán Hàng</title>
    <link rel='stylesheet' type='text/css' href='style/style.css'>
    <link rel='stylesheet' type='text/css' href='style/bootstrap-5.0.2/css/bootstrap.min.css'>
    <script src='style/bootstrap-5.0.2/js/bootstrap.min.js'></script>
    <link rel='stylesheet' type='text/css' href='style/style_chitietsanpham.css'>
    <meta name='viewport' content='width=divice-width,initial-scale=1'>
    <script>
        var myModal = document.getElementById('myModal')
        var myInput = document.getElementById('myInput')
        myModal.addEventListener('shown.bs.modal', function () {
        myInput.focus()
        })
    </script>
</head>
<body>
    <div class="body">
        <header>    
            <div class='header'>
            <?php
                    include 'header.php';
            ?>
            </div>
        </header>  
        <div class='clear'>   
        </div>
        <div class='screen'>
            <div class='left'>
                <?php
                    include "Admin/connect.php";
                    if(isset($_GET['id']))
                    {
                        $query='SELECT * FROM `sanpham` WHERE `id`='.$_GET['id'];
                        $data=mysqli_query($connect,$query);                                                
                        while($row=mysqli_fetch_array($data))
                        {
                            $anhsp=explode('|',$row['anhsanpham']);
                            if(isset($_GET['anh']))
                            foreach($anhsp as $key => $val)
                            {
                                if ($_GET['anh']==$key)
                                {
                                    echo '<img src="file_img/'.$val.'">';
                                }
                            }
                            else
                            {
                                echo '<img src="file_img/'.$anhsp[0].'">';
                            } 
                        }                                                                      
                    }
                    if(isset($_GET['id']))
                    {
                        $query='SELECT * FROM `sanpham` WHERE `id`='.$_GET['id'];
                        $data=mysqli_query($connect,$query);                      
                        while($row=mysqli_fetch_array($data))
                        {                           
                            echo'
                            <div class="imgmini">';
                            $anhsp=explode('|',$row['anhsanpham']);
                            foreach($anhsp as $key => $val)
                            {
                                echo'
                                <a href="chitietsanpham.php?anh='.$key.'&id='.$_GET['id'].'">
                                    <img src="file_img/'.$val.'">
                                </a>';
                            }
                            echo'</div>';
                    echo '</div>
                    <div class="right">
                        <p>'.$row['tensanpham'].'</p>
                        <p>Giá:'.$row['giacu'].' </p>
                        <p>'.$row['thongtinsanpham'].'</p>';
                        include 'giohang.php';
                        echo
                    '</div>
                </div>
            </div>';
                }
            }    
?> 
                
    <div class="clear">
    </div>
    <div class="body">
        <div class='thongbao'>
            <h5>Sản phẩm tương tự:</h5> 
        </div>
        <?php
            include 'sanphamtuongtu.php';
        ?>
    <div class='clear'>   
    </div>
    <?php
    include 'footer.php';
    ?>
</body>
</html>