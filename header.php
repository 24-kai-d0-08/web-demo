<header>    
    <div class='header'>
    <div class='logo'>
        <?php
        $db_handle = mysqli_connect('localhost','root','','webbanhang');
        $query='SELECT * FROM `logo` WHERE 1';
        $data=mysqli_query($db_handle,$query);
        while($row = mysqli_fetch_array($data))
        {
            echo '<img src="'.$row['link'].'">';
            echo '<p class="tenthuonghieu">'.$row['thuonghieu'].'</p>';
        }
        ?>  
    </div>
    <div class='iconmenu'>
        <img src="file_img/iconmenu.png">
    </div>
    <script>
        $(document).ready(function(){
            $('.iconmenu').click(function(){
                $('.menu').toggle(300);
            })
        });
    </script>
        
    <div class='search-tk'>
        <form method='post' action='trangketqua.php'>
            <input id='search-tk' type='text' name='search'>  
            <button type='submit' class='nut-tk'>
                <img src='file_img/search.png'> 
            </button>
        </form>
    </div>
    <div class='contact'>
        <h5>Liên hệ với chúng tôi</h5>
        <?php 
            $query='SELECT * FROM `contact` WHERE 1';
            $data=mysqli_query($db_handle,$query);
            $dem=0;
            while($row = mysqli_fetch_array($data))
            {
                
                if($row['tieude']=='sdt')
                {
                    $dem++;
                    echo '<h6>SĐT '.$dem.':'.$row['noidung'].'</h6>';
                }
                if($row['tieude']=='email')
                {
                    echo '<h6>
                            Gmail:<a href="mailto:'.$row['noidung'].'">'.$row['noidung'].'</a>
                        </h6>';
                }
            }
        ?>
    </div>
</div>
</header>
<div class='menu'>  

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
</div>