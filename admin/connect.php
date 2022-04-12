<?php
$Host='localhost';
$user='root';
$password='';
$database='webbanhang';
$connect = mysqli_connect($Host,$user,$password,$database);
mysqli_query($connect,"SET NAMES 'utf8'");
mysqli_query($connect,"SET CHARACTER SET 'utf8'");
?>