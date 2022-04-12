<?php
    include "Admin/connect.php";
    $muc='';
    if(isset($_GET['id']))
    {
        $query='SELECT `danhmuc` FROM `sanpham` WHERE `id`='.$_GET['id'];
        $data=mysqli_query($connect,$query);                                                
        while($row=mysqli_fetch_array($data))
        {
            $muc=$row['danhmuc'];
        }
        $query='SELECT * FROM `sanpham` WHERE `danhmuc`='.$muc;
        $data=mysqli_query($connect,$query);
        $stt=1;                                                
        while($row=mysqli_fetch_array($data))
        {
            if($stt<=4)
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
                                sp tuong tu
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
            $stt++;
        }
    }
?>
