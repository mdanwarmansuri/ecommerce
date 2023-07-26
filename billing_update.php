<?php
include('Conn.php');
session_start();
$id = $_POST['remove'];
$user=$_SESSION['uname'];
$sql = "DELETE FROM cart where uname='$user' and prod_id='$id'";
$res=mysqli_query($con,$sql);
if($res)
    echo "<script>alert('Removed Successfully')</script>";
else
echo "<script>alert('Something went wrong')</script>";
header("location: billing.php");
?>