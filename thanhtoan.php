<?php
session_start();
?>
<html>
<head>
    <meta charset='utf-8'>
    <title>Thanh toán</title>
    <link rel='stylesheet' type='text/css' href='style/style.css'>
    <link rel='stylesheet' type='text/css' href='style/bootstrap-5.0.2/css/bootstrap.min.css'>
    <script src='style/bootstrap-5.0.2/js/bootstrap.min.js'></script>
    <meta name='viewport' content='width=divice-width,initial-scale=1'>
    <script src='style/jquery-3.6.0.min.js'></script>
    <script>
        $(document).ready(function(){
            $('.soluong').change(function(){
                var soluong=this.value;
                var gia=this.id;
                var tong='.'+this.name;
                var idsp=this.name;
                var data={'sanpham':idsp,'soluong':soluong};
                $(tong).text(soluong*gia);  
                $.post('khachhang.php',data);
            });
        });
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
        <center>
            <h2 class="title-donhang">Đơn hàng của bạn</h2>
        </center>
        
        <div class="content">
            <table>
                <tr class="tr">
                    <th class="cot-stt">Stt</th>
                    <th class="cot-sanpham">Sản phẩm</th>
                    <th class="cot-soluong">Số Lượng</th>
                    <th class="cot-gia">Giá</th>
                    <th class="cot-giatong">Tổng tiền</th>  
                    <th class="cot-anh">Ảnh</th>
                    <th class="cot-thaotac">Thao tác</th>              
                </tr>
                <?php
                    include "Admin/connect.php"; 
                    $list_id=implode(',',$_SESSION['giohang']);
                    $query='SELECT * FROM `sanpham` WHERE `id`IN('.$list_id.')';   
                    $data=mysqli_query($connect,$query);
                    $stt=1;
                    while($row=mysqli_fetch_array($data))
                    {  
                        $anh1=explode('|',$row['anhsanpham']);
                        $anh=$anh1[0];
                        $maunen='';
                        if($stt%2==1)
                        {
                            $maunen='maunen-tr';
                        }
                        echo'
                            <tr class="'.$maunen.'">
                            <td class="cot-stt">'.$stt.'</td>
                            <td class="cot-sanpham">'.$row['tensanpham'].'</td>
                            <td class="cot-soluong">
                                <input class="soluong" id="'.$row['giamoi'].'" type="number" min="1" name="'.$row['id'].'" value="1">
                            </td>
                            <td id="gia'.$stt.'" class="cot-gia">'.$row['giamoi'].'</td>
                            <td id="tong'.$stt.'" class="cot-giatong '.$row['id'].'">'.$row['giamoi'].'</td>
                            <td class="cot-anh"><img src="file_img/'.$anh.'" ></td>
                            <td class="cot-thaotac">
                                <a href="xoadonhang.php?spxoa='.$row['id'].'" class="nut-huy">   
                                    Xóa đơn hàng
                                </a>
                            </td>
                        </tr>
                        ';
                        if($stt==1)
                        {
                            $_SESSION['don-hang']=$row['id'].'|1';
                        }
                        else
                            $_SESSION['don-hang'].=','.$row['id'].'|1';
                        $stt++;
                    }
                    if(isset($_SESSION['soluong']))
                    {
                        $sp_capnhat=explode("|",$_SESSION['soluong']);
                        $t=$_SESSION['don-hang'];
                        $ds_hang=explode(",",$t);
                        foreach($ds_hang as $key =>$value)
                        {
                            $sp_sosanh=explode("|",$value);
                            if($sp_capnhat[0]==$sp_sosanh[0])
                            {
                                $ds_hang[$key]=$_SESSION['soluong'];
                            }
                        }
                        $_SESSION['don-hang']=implode(",",$ds_hang);
                    }
                ?>  
            </table>
            <p>
                <a href="index.php" >
                    <button class="tieptuc">Tiếp tục mua hàng</button>
                </a>
            </p>
        </div>
       
        <div class='content'>   
             <form class="row g-3" action="khachhang.php" method="post">
                <h4>Thông tin của bạn:</h4>
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Họ và Tên:</label>
                    <input type="text" class="form-control" id="inputEmail4" name="ten">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Số điện thoại</label>
                    <input name="sdt" type="number" class="form-control" id="inputPassword4">
                </div>
                <div class="col-12">
                    <label for="inputAddress" class="form-label">Địa chỉ</label>
                    <input name="address" type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                </div>
                <div class="col-12">
                    <label for="inputAddress2" class="form-label">Email</label>
                    <input name="email" type="email" class="form-control" id="inputAddress2" placeholder="Nhập Email liên hệ">
                </div>
                <div class="col-12">
                    <div class="form-check">
                    <input value="1" name="check" class="form-check-input" type="checkbox" id="gridCheck">
                    <label  class="form-check-label" for="gridCheck">
                        Đồng ý thanh toán
                    </label>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Thanh toán</button>
                </div>
            </form>
        </div>   
    </div>
    <div class='clear'>   
    </div>
    <footer>
        <h3>~Luôn đảm bảo chất lượng và giá cả~</h3>
        <p>@2021 copyright: Đỗ văn Vượng</p>
    </footer>
</body>
</html>