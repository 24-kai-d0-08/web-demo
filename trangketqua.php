<html>
<head>
    <meta charset='utf-8'>
    <title>Bán Hàng</title>
    <link rel='stylesheet' type='text/css' href='style/style.css'>
    <link rel='stylesheet' type='text/css' href='style/bootstrap-5.0.2/css/bootstrap.min.css'>
    <script src='style/bootstrap-5.0.2/js/bootstrap.min.js'></script>
    <meta name='viewport' content='width=device-width,initial-scale=1.0'>
    <script src='style/jquery-3.6.0.min.js'></script>
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
            <?php
                include 'header.php';
            ?>
        <div class='clear'>   
    </div>
<?php
    include "Admin/connect.php";
    $query='';
    if(isset($_POST['search'])&&$_POST['search']!='')
    {
        include("chucnang/tiengviet.php");
        $tk=strtolower($_POST['search']);
        $tim=explode(" ",$tk);//mang tim kiem
        $query1='SELECT * FROM `sanpham` WHERE 1';
        $data1=mysqli_query($connect,$query1);
        $idtk=array();
        while($row1=mysqli_fetch_array($data1))
        {
            $tensp=strtolower($row1['tensanpham']);
            $tensp=tiengviet($tensp);
            $sosanh=explode("-",$tensp);//mang so sanh
            $ketqua=array_intersect($tim,$sosanh);
            $dem=count($ketqua);
            if($dem>0)
            {
                $idtk[$row1['id']]=$dem;
            }
        }
        arsort($idtk);
        foreach($idtk as $key => $value)
        {
            $query='SELECT * FROM `sanpham` WHERE `id`='.$key;
            $data=mysqli_query($connect,$query);                                                                                                
            while($row=mysqli_fetch_array($data))
            {
                echo '<div class="sanpham">';
                $anhsp=explode('|',$row['anhsanpham']);
                echo'<div class="boxanhsp">
                        <img src="file_img/'.$anhsp[0].'">
                    </div>';
                echo'
                    <h5>'.$row['tensanpham'].'</h5>
                    <h5>Giá sản phẩm:'.$row['giamoi'].'</h5>
                    <button type="button" class="btn btn-primary mua" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><img src="file_img/mua.png" alt="Mua"></button>
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Thông tin giỏ hàng</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ...
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tiếp tục mua hàng</button>
                                        <button type="button" class="btn btn-primary">Thanh toán</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>';
            }
        }
        if(count($idtk)==0)
        {
            echo '<p style="color:red;">Không tìm thấy sản phẩm</p>';
        }   
    }
    
?>
<div class='clear'>
</div>
<?php
    include 'footer.php';
?>
</body>
</html>
