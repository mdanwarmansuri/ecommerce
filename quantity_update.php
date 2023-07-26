<?php
include("Conn.php");
include("admin_secure.php");
$id=$_POST['update'];
$quant=$_POST['quantity'];
$sql="update products set quantity='$quant' where id='$id'";
if(mysqli_query($con,$sql)){
    echo "<script>alert('Quantity Updated')</script>";
    include('admin_panel.php');
}
?>