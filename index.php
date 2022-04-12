<?php
    session_start();
    if(!isset($_SESSION['giohang']))
    {
        $_SESSION['giohang']=array();
    }
    
?>
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
        $(document).ready(function(){
            var x=window.location.search;
            if(x!='')
            {
                $('.dsach-mua').addClass('hien-giohang');
            }
            $('.muaicon').click(function(){
                $('.dsach-mua').addClass('hien-giohang');   
            });
            $('.iconM').click(function(){
                var y=this.name;
                var url='giohang.php';
                var data={'giohang':y};
                $('.dsach-mua').load(url,data);
                               
            })
            /*var url="name=iphone&gia=100";
            let giohang=new URLSearchParams(url);    
            var x=searchParams.get(gia);
            console.log(url); */
        });

    </script>
</head>
<body>
    <div class="body">
            <?php
                    include 'header.php';
            ?>
        <div class='clear'>   
        </div>
        <div class='slide'>
            <?php
                include 'slide.php';
            ?>     
        </div>
        <div class='clear'>   
        </div>
        <div class='content'>   
                <?php
                    include 'chucnang/hienthisanpham.php';
                    include 'sanphammoi.php';
                    include 'sanphamhot.php';
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