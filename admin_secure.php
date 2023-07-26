<?php
session_start();
if(!isset($_SESSION['uname'])){
    header("location: index.php");
}
if(isset($_SESSION['uname']) && $_SESSION['role']!='admin')
header("location: 4 order.php");
?>