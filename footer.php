<footer>
    <?php
        include 'admin/connect.php';
        $query='SELECT * FROM `footer` WHERE 1';
        $data=mysqli_query($connect,$query);
        while($row=mysqli_fetch_array($data))
        {
            echo $row['nd_footer'];
        }
    ?>
</footer>