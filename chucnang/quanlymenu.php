<h3>Quản lý Menu</h3>
<table class="table">
    <tr class="tr">
        <th class="stt">Stt</th>
        <th class="menuchinh">Mục chính</th>
        <th class="menuphu">Mục phụ</th>
    </tr>
    <?php
        include "connect.php";
        if(isset($_POST['them'])&&isset($_POST['menuchinh']))//chuc nang them menu con
        {
            include "../admin/connect.php";
            $query='INSERT INTO `menu`(`id`, `idcha`, `tenmenu`) VALUES ("'.time().'","'.$_POST['menuchinh'].'","'.$_POST['them'].'")';
            if(mysqli_query($connect,$query))
            {
                header ('location:../admin/index.php?page=quanlymenu');
            }
        }
        if(isset($_POST['menucon'])&&isset($_POST['sua'])&&isset($_POST['tenmenucon']))//chuc nang sua menu con
        {
            include "../admin/connect.php";
            $query='UPDATE `menu` SET `tenmenu`="'.$_POST['tenmenucon'].'" WHERE `id`='.$_POST['menucon'];
            if(mysqli_query($connect,$query))
            {
                header ('location:../admin/index.php?page=quanlymenu');
            }
        }
        if(isset($_POST['menucon'])&&isset($_POST['xoa'])&&isset($_POST['tenmenucon']))//chuc nang xoa menu con
        {
            include "../admin/connect.php";
            $query='DELETE FROM `menu` WHERE `id`='.$_POST['menucon'];
            if(mysqli_query($connect,$query))
            {
                header ('location:../admin/index.php?page=quanlymenu');
            }
        }
        if(isset($_POST['menuchinh'])&&isset($_POST['sua'])&&isset($_POST['tenmenuchinh']))//chuc nang sua menu chinh
        {
            include "../admin/connect.php";
            $query='UPDATE `menu` SET `tenmenu`="'.$_POST['tenmenuchinh'].'" WHERE `id`='.$_POST['menuchinh'];
            if(mysqli_query($connect,$query))
            {
                header ('location:../admin/index.php?page=quanlymenu');
            }
        }
        if(isset($_POST['menuchinh'])&&isset($_POST['xoa'])&&isset($_POST['tenmenuchinh']))//chuc nang xoa menu chinh
        {
            include "../admin/connect.php";
            $query='DELETE FROM `menu` WHERE `id`='.$_POST['menuchinh'].' OR `idcha`='.$_POST['menuchinh'];
            if(mysqli_query($connect,$query))
            {
                header ('location:../admin/index.php?page=quanlymenu');
            }
        }
        if(isset($_POST['themmenuchinh']))//chuc nang them menu chinh
        {
            include "../admin/connect.php";
            $query='INSERT INTO `menu`(`id`, `idcha`, `tenmenu`) VALUES ("'.time().'","0","'.$_POST['themmenuchinh'].'")';
            if(mysqli_query($connect,$query))
            {
                header ('location:../admin/index.php?page=quanlymenu');
            }
        }
        $query='SELECT  * FROM `menu` WHERE 1';
        $data=mysqli_query($connect,$query);
            while($row=mysqli_fetch_array($data))
            {
                if($row['idcha']==0)
                {
                    echo '<tr class="tr">
                            <td class="stt">1</td>
                            <td class="menuchinh">
                                <form action="../chucnang/quanlymenu.php" method="post">
                                    <input type="hidden" name="menuchinh" value="'.$row['id'].'">
                                    <input type="text" value="'.$row['tenmenu'].' " name="tenmenuchinh" class="omenuchinh" >
                                    <input type="submit" name="sua" value="Sửa" class="nutadmin">
                                    <input type="submit" name="xoa" value="Xóa" class="nutadmin">   
                                </form>
                            </td>   
                        <td class="menuphu">';
                        $query1='SELECT  * FROM `menu` WHERE `idcha`='.$row['id'];
                        $data1=mysqli_query($connect,$query1);
                        while($row1=mysqli_fetch_array($data1))
                        {
                            echo '<p>
                                    <form action="../chucnang/quanlymenu.php" method="post">
                                        <input type="hidden" name="menucon" value="'.$row1['id'].'">
                                        <input type="text" value="'.$row1['tenmenu'].'" name="tenmenucon" class="omenucon">
                                        <input type="submit" name="sua" value="Sửa" class="nutadmin">
                                        <input type="submit" name="xoa" value="Xóa" class="nutadmin">
                                    </form> 
                                 </p>';
                        }
                        echo '<p>
                                <form action="../chucnang/quanlymenu.php" method="post">
                                    <input type="hidden" name="menuchinh" value="'.$row['id'].'">
                                    <input type="text" name="them" placeholder="Thêm mục" class="omenucon">
                                    <input type="submit" value="Thêm" class="nutadmin">
                                </form>
                            </p>';
                }
            }
    ?>
    </table>
    <p>
        <form action="../chucnang/quanlymenu.php" method="post">
            <input type="text" name="themmenuchinh" placeholder="Thêm mục chính" class="themmenuchinh">
            <input type="submit" value="Thêm" class="nutadmin">
        </form>
    </p>
          
            