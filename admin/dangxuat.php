<?php
session_start();
if(isset($_SESSION['loginwebbanhang']))
{
    unset($_SESSION['loginwebbanhang']);
    header('location:login.php');
}
?>