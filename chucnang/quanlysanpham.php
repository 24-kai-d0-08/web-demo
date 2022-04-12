<?php
    if(isset($_POST['danhmuc'])&&isset($_POST['sort']))
    {
        include "../admin/connect.php";
        $id=$_POST['danhmuc'];
        $query='SELECT * FROM `menu` WHERE `id`='.$id;
        $data=mysqli_query($connect,$query);
        while($row=mysqli_fetch_array($data))
        {
            if($row['idcha']==0)
            {
                $query1='SELECT * FROM `menu` WHERE `idcha`='.$id;
                $data1=mysqli_query($connect,$query1);
                $stt=0;
                while($row1=mysqli_fetch_array($data1))
                {
                    if($stt==0)
                    {
                        $id=$row1['id'];
                    }
                    else
                        $id.='|'.$row1['id'];
                    $stt++;
                }
            }
        }
        $sort=$_POST['sort'];
        $search='';
        if(isset($_POST['search'])&&trim($_POST['search'])!='')
        {
            include("tiengviet.php");
            $search=tiengviet($_POST['search']);
        }
        header("location:../admin/index.php?page=quanlysanpham&danhmuc=".$id.'&sort='.$sort.'&search='.$search);
    }
    else
    include "../admin/connect.php";   
?>
<h3>Quản lý sản phẩm</h3>
<form method="post" action="../chucnang/quanlysanpham.php">
    Danh mục sản phẩm:
    <select name="danhmuc"> 
        <option value="-1">-----------</option>
        <?php
            $query='SELECT * FROM `menu` WHERE 1';
            $data=mysqli_query($connect,$query);
            while($row=mysqli_fetch_array($data))
            {
                echo'<option value="'.$row["id"].'">'.$row['tenmenu'].'</option>';   
            }
        ?>
    </select>
    Hiển thị theo:
    <select name="sort"> 
        <option value="0">-----------</option>
        <option value="1">Mới nhất</option>
        <option value="2">Cũ nhất</option>
        <option value="3">Giá tăng dần</option>
        <option value="4">Giá giảm dần</option>
        <option value="5">Sản phẩm bán chạy nhất</option>
    </select>
    <input class="search" type="text" name="search" placeholder="Nhập vào tên sản phẩm">
    <input class="search" type="submit" value="Tìm kiếm">
</form>
<table class="table">
    <tr class="tr">
        <th class="stt">Stt</th>
        <th class="cotmucsanpham">Mục sản phẩm</th>
        <th class="cotsanpham">Sản phẩm</th>
        <th class="cotgia">Giá</th>
        <th class="cotthaotac">Thao tác</th>
    </tr>
    <?php
        $query='SELECT * FROM `sanpham` WHERE 1';
        if(isset($_GET['danhmuc'])&&$_GET['danhmuc']!= -1)
        {
            $dk=explode("|",$_GET['danhmuc']);
            $dk=implode(" OR `danhmuc`=",$dk);
            $query='SELECT * FROM `sanpham` WHERE `danhmuc`='.$dk;
        }
        if(isset($_GET['sort']))
        {
            if($_GET['sort']==1)
            {
                $query.=' ORDER BY `id` DESC';
            }
            if($_GET['sort']==2)
            {
                $query.=' ORDER BY `id`';
            }
            if($_GET['sort']==3)
            {
                $query.=' ORDER BY `giamoi` ';
            }
            if($_GET['sort']==4)
            {
                $query.=' ORDER BY `giamoi` DESC';
            }
            if($_GET['sort']==5)
            {
                $query.=' ORDER BY `sldaban` DESC';
            }
        }
        $check=0;
        if(isset($_GET['search'])&&$_GET['search']!='')
        {
            include("../chucnang/tiengviet.php");
            $tk=strtolower($_GET['search']);
            $tim=explode("-",$tk);//mang tim kiem
            $query1='SELECT * FROM `sanpham` WHERE 1';
            $data1=mysqli_query($connect,$query1);
            $idtk=array();
            while($row1=mysqli_fetch_array($data1))
            {
                $tensp=strtolower($row1['tensanpham']);
                $tensp=tiengviet($tensp);
                $sosanh=explode("-",$tensp);//mang so sanh
                $ketqua=array_intersect($tim,$sosanh);
                if(count($ketqua)>=1)
                {
                    $idtk[]=$row1['id'];
                }
            }
            $tk1=implode(' OR `id`=',$idtk);
            if($tk1!='')
                $query='SELECT * FROM `sanpham` WHERE `id`='.$tk1;
            else
            {
                $check=1;
                echo '<p style="color:red;">Không tìm thấy sản phẩm</p>';
            }   
        }
        $query3='SELECT `phantrangadmin` FROM `settingtrangweb` WHERE 1';
        $phantrang=0;
        $tongsanpham=0;
        $data3=mysqli_query($connect,$query3);            
        while($row1=mysqli_fetch_array($data3))
        {
            $phantrang=$row1['phantrangadmin'];
        }
        $trang=1;
        if(isset($_GET['trang']))
        {
            $trang=$_GET['trang'];
        }
        if($check==0)
        {
           $data=mysqli_query($connect,$query);
            $stt=1;
            while($row=mysqli_fetch_array($data))
            {
                $query1='SELECT  `tenmenu` FROM `menu` WHERE `id`='.$row['danhmuc'];
                $data1=mysqli_query($connect,$query1);
                $danhmuc='';
                while($row1=mysqli_fetch_array($data1))
                {
                    $danhmuc=$row1['tenmenu'];
                }
                $dsanh=explode('|',$row['anhsanpham']);
                
                if($stt>($trang-1)*$phantrang&&$stt<=$trang*$phantrang)
                echo 
                    '<tr class="tr">
                        <td class="stt">'.$stt.'</td>
                        <td class="cotmucsanpham">'.$danhmuc.'</td>
                        <td class="cotsanpham">
                            <p>
                                <img src="../file_img/'.$dsanh[0].'">
                            </p>
                            <p>'.$row['tensanpham'].'</p> </td>
                        <td class="cotgia">'.$row['giamoi'].'VND</td>
                        <td class="cotthaotac"><a href="../chucnang/xoasanpham.php?xoa='.$row['id'].'">xoa</a>
                        |<a href="../chucnang/suasanpham.php?sua='.$row['id'].'">sua</a></td>
                    </tr>';
                $stt++;
            } 
            $tongsanpham=$stt-1;
            $sotrang=ceil($tongsanpham/$phantrang);
        }       
    ?>   
</table>
<p class="bot">
    
    <?php 
    echo
        '<a href="index.php?page=quanlysanpham&trang=1">Trang đầu
        </a>
        <a href="index.php?page=quanlysanpham&trang='.(($trang==1)?$trang:$trang-1).'">
            <img class="next" src="../file_img/preview.png">
        </a>';
        if($trang<=3)
        {
            for($i=1;$i<=5&&$i<=$sotrang;$i++)
            {
                if($i==$trang)
                    {
                        echo '<a class="trangchon" href="index.php?page=quanlysanpham&trang='.$i.'">'.$i.'</a>';
                    }
                    else
                    {
                        echo '<a href="index.php?page=quanlysanpham&trang='.$i.'">'.$i.'</a>';
                    }
            }
        }
        else 
        {
            if($trang==$sotrang)
            {
                for($i=$trang-4;$i<=$trang+2&&$i<=$sotrang;$i++)
                {
                    if($i==$trang)
                    {
                        echo '<a class="trangchon" href="index.php?page=quanlysanpham&trang='.$i.'">'.$i.'</a>';
                    }
                    else
                    {
                        echo '<a href="index.php?page=quanlysanpham&trang='.$i.'">'.$i.'</a>';
                    }
                }
            }
            if($trang==$sotrang-1)
            {
                for($i=$trang-3;$i<=$trang+2&&$i<=$sotrang;$i++)
                {
                    if($i==$trang)
                    {
                        echo '<a class="trangchon" href="index.php?page=quanlysanpham&trang='.$i.'">'.$i.'</a>';
                    }
                    else
                    {
                        echo '<a href="index.php?page=quanlysanpham&trang='.$i.'">'.$i.'</a>';
                    }
                }
            }
            if($trang<=$sotrang-2)
            for($i=$trang-2;$i<=$trang+2&&$i<=$sotrang;$i++)
            {
                if($i==$trang)
                    {
                        echo '<a class="trangchon" href="index.php?page=quanlysanpham&trang='.$i.'">'.$i.'</a>';
                    }
                    else
                    {
                        echo '<a href="index.php?page=quanlysanpham&trang='.$i.'">'.$i.'</a>';
                    }
            }
        }
        echo'
    <a href="index.php?page=quanlysanpham&trang='.(($trang==$sotrang)?$trang:$trang+1).'">
        <img class="next" src="../file_img/next.png">
    </a>
    <a href="index.php?page=quanlysanpham&trang='.$sotrang.'">Trang cuối
        </a>';
    ?>
<form action="../chucnang/phantrang.php" method="post" class="object_in_page">
    Số sản phẩm hiện trong 1 trang:
    <select name="page">
        <?php
            
            echo '<option selected="selected" value="'.$phantrang.'">'.$phantrang.'</option>';
        ?>
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="15">15</option>
    </select>
    <input type="submit" value="Lưu" class="luu">
</form>

    <a href='themsanpham.php'>
        <h5>Thêm sản phẩm mới</h5>
    </a>
</p>
