<?php
session_start();
if(!isset($_SESSION['uname'])){
    header("location: index.php");
}
else if(isset($_SESSION['uname']) && $_SESSION['role']=='admin')
header("location: admin_panel.php");
?>