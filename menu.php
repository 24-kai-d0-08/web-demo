<ul class='menu'>
   <li class='ds-menu'>
         <a href="index.php">Trang chủ</a> 
   </li>
   <?php
   include 'admin/connect.php';
   $query='SELECT  * FROM `menu` WHERE 1';
   $data=mysqli_query($connect,$query);
   while($row=mysqli_fetch_array($data))
   {
      if($row['idcha']==0)
      {
         echo '<li class="ds-menu">
               <a href="trangsanpham.php?page='.$row['id'].'">'.$row['tenmenu'].'</a> 
               <ul class="menu-con">';
               $query1='SELECT  * FROM `menu` WHERE `idcha`='.$row['id'];
               $data1=mysqli_query($connect,$query1);
               while($row1=mysqli_fetch_array($data1))
               {
                     echo '<li class="ds-con">
                     <a href="trangsanpham.php?page='.$row1['id'].'">'.$row1['tenmenu'].'</a> </li>';
               }
         echo '</ul>
         </li>';      
      }
   }
   ?>
</ul>
            