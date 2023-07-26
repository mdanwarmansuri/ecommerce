<?php
include('billing.php');
$uname = $_SESSION['uname'];
$flag = $_SESSION['confirmflag'];
$user=$_SESSION['user'];
$mobile=$_SESSION['mobile'];

if ($flag == 0) {
    echo "<script>alert('Some item is out of stock')";
    header("location: billing.php");
} else {
    $sql = "select * from cart where uname='$uname'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row["prod_id"];
                $name = $row["prod_name"];
                $price = $row["price"];
                $quantity = $row["quantity"];
                $cost = $row["cost"];
                $date = date("Y-m-d");
                $location = $row['location'];

                $sql1 = "INSERT INTO `orders`(`uname`,`user`,`mobile`,`prod_id`,`prod_name`, `price`, `quantity`, `cost`, `location`, `date`,`status`) VALUES('$uname','$user','$mobile','$id','$name','$price','$quantity','$cost','$location','$date','Order Placed')";
            }
            $res1 = mysqli_query($con, $sql1);
            if ($res1) {
                $sql2 = "UPDATE products SET quantity=quantity-$quantity WHERE id='$id'";
                $result2 = mysqli_query($con, $sql2);
                $result3 = mysqli_query($con, "delete from cart where uname='$uname'");
                if ($result2 && $result3) {
                    echo "<script>alert('Order Placed Successfully')</script>";
                    echo "<h3 style='color:green;'>Order Placed Successfully</h3>";
                } else{
                    echo "<h3 style='color:red;'>Something went wrong</h3>";
                }
            }
        }
        else
        echo "<script>alert('There is nothing in the cart')</script>";
    }
}
