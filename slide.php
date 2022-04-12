<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
    <?php
        include 'admin/connect.php';
        $query1='SELECT COUNT(*) FROM `slide` WHERE 1 ';
        $dem=mysqli_query($connect,$query1);
        $soluong=0;
        $row=mysqli_fetch_array($dem);
        $soluong=$row[0];
        echo'<div class="carousel-indicators">';
        for($i=0;$i<$soluong;$i++)
        {
            echo' <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="'.$i.'" '.($i==0?'class="active"':'').' aria-current="true" aria-label="Slide 1"></button>';
        }
        echo '</div>
        <div class="carousel-inner">';
        $query='SELECT * FROM `slide` WHERE 1';
        $data=mysqli_query($connect,$query);
        $i=0;
        while($row=mysqli_fetch_array($data))
        {
            echo '<div class="carousel-item '.($i==0?'active':'').'" data-bs-interval="10000">
                    <img src="file_img/'.$row['tenanh'].'"class="d-block w-100">
                    <div class="carousel-caption d-none d-md-block">
                        <p>'.$row['tieude'].'</p>
                    </div>
                </div>';
            $i++;
        }   
        echo '</div>';
    ?>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
    </div>