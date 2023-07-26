<?php
include("Conn.php");
include("admin_secure.php");
$id=$_POST['submit'];
$status=$_POST['status'];
$sql2="update orders set status='$status' where order_id=$id";
$res=mysqli_query($con,$sql2);
if($res){
    echo "<script>alert('Order Status Updated Successfully')</script>";
}
else
echo "<script>alert('Something went wrong')</script>";
header("location: see_orders.php");
?>