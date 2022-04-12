<head>
    <link rel='stylesheet' type='text/css' href='../style/admin.css'>
    <!--<script src="../ckediter/ckeditor.js"></script>!-->
    <script src="../style/ckeditor/ckeditor.js"></script>
</head>
<body>
    <form action="../chucnang/quanlyfooter.php" method="post">
    <textarea name="nd_footer" id="editor" >
        <?php
            if(isset($_POST['nd_footer']))
            {
                include '../admin/connect.php';
                $query='UPDATE `footer` SET `nd_footer`="'.$_POST['nd_footer'].'" WHERE 1';
                if(mysqli_query($connect,$query))
                {
                    header('location:../admin/index.php?page=quanlyfooter');
                }
            }else
            include 'connect.php';
            $query='SELECT * FROM `footer` WHERE 1';
            $data=mysqli_query($connect,$query);
            $footer='';
            while($row=mysqli_fetch_array($data))
            {
                $footer=$row['nd_footer'];    
            }
            echo $footer;
            
        ?>
    </textarea>
    <p><input type="submit" value="Lưu thay đổi"></p> 
     <script>
        CKEDITOR.replace('editor');
    </script>
</form>
</body>
