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
        <div class='clear'></div>   
    <div class='content'>   
    <div class='blog'>
    <div class='thongbao'>
            <h5>Sản phẩm</h5>
    </div>
    <?php
        include "Admin/connect.php";
        $slsptranghienthi=16;
        // $query='SELECT  `slsp_hot` FROM `settingtrangweb` WHERE 1';      
        // $data=mysqli_query($connect,$query);
        // while($row=mysqli_fetch_array($data))
        // {  
        //     $slsptranghienthi=$row['slsp_hot'];
        // }
        $dk=1;
        if(isset($_GET['page']))
        {
            $page=$_GET['page'];
            $query='SELECT `idcha` FROM `menu` WHERE `id`='.$page;
            $data=mysqli_query($connect,$query);
            while($row=mysqli_fetch_array($data))
            {
                if($row['idcha']==0)
                {
                    $query1='SELECT * FROM `menu` WHERE `idcha`='.$page;
                    $data1=mysqli_query($connect,$query1);
                    while($row1=mysqli_fetch_array($data1))
                    {
                        if($dk==1)
                        {
                            $dk='`danhmuc`='.$row1['id'];
                        }
                        else{
                            $dk.=' OR `danhmuc`='.$row1['id'];
                        }
                    }
                }
                else{
                    $dk='`danhmuc`='.$page;
                }
            }
        }
        $query='SELECT * FROM `sanpham` WHERE'.$dk;
        $data=mysqli_query($connect,$query);
        $stt=0;
        while($row=mysqli_fetch_array($data))
        {
            $stt++;
            $dsanh=explode('|',$row['anhsanpham']);
            if($stt<=$slsptranghienthi)               
            echo    '<div class="sanpham">
                    <div class="boxanhsp">
                        <a href="chitietsanpham.php?id='.$row['id'].'">
                        <img class="anhsp" src="file_img/'.$dsanh[0].'" ></a>
                    </div>
                    <a href="chitietsanpham.php?id='.$row['id'].'"><h5>'.$row['tensanpham'].'</h5></a>
                    <p>Giá sản phẩm:'.$row['giamoi'].'</p>
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
                </div>';
        }
    ?>       
    </div>
    </div>
    <div class='clear'>   
    </div>
    <?php
    include 'footer.php';
    ?>
</body>
</html>