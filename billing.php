
<?php
include("user_secure.php");
?>
<html>

<head>
    <title> Medicine Shopping - Order </title>
    <style>
        .header {
            overflow: hidden;
            background-color: #f1f1f1;
            padding: 20px 10px;
        }

        .header a {
            font-family: Georgia, 'Times New Roman', Times, serif;
            float: left;
            color: black;
            text-align: center;
            padding: 12px;
            text-decoration: none;
            font-size: 18px;
            line-height: 25px;
            border-radius: 4px;
        }

        .header a.logo {
            font-size: 25px;
            font-weight: bold;
        }

        .header a:hover {
            background-color: #ddd;
            color: black;
        }

        .header a.active {
            background-color: dodgerblue;
            color: white;
        }

        input {
            width: 100%;
            padding: 6px;
        }

        input[type=submit] {
            cursor: pointer;
        }

        #left {
            margin-left: auto;
            margin-right: auto;
            width: 20%;
        }

        #left-l {
            background-color: aquamarine;
            padding: 20px;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            font-size: 18px;
        }

        #left-l #submit {
            width: 25%;
            margin-top: 10px;
        }

        #logout {
            float: right;
        }

        #create th,
        tr,
        td {
            border: 1px solid black;
            padding: 30px;
            text-align: center;
            background-color:azure;
            padding-left: 50px;
            padding-right: 50px;
        }

        #create{
            margin:10px;
        }

        tr {
            color: coral;
        }

        th {
            color: black;
        }
        #head{
            margin:20px;
        }
        #p1{
            margin:20px;
            padding:30px;
            background-color:honeydew;
            width:50%;
            border-radius:8px;
        }
        #p2{
            margin:20px;
            padding:30px;
            background-color:mediumaquamarine;
            width:30%;
            font-size: larger;
            border-radius: 8px;
        }
        #changeaddr{
            margin:10px;
            padding:10px;
            background-color:darkcyan;
            border-radius: 5px;

        }
        #finalpay{
            margin:10px;
            padding:10px;
            padding-left:40px;
            padding-right: 40px;
            background-color:cadetblue;
            border-radius: 5px;
        }
        #create th{
        padding:10px;
        background-color:powderblue;
        }
        #pay{
            text-decoration: none;
            color: black;
        }
        #logout {
            float: right;
            border:none;
            color: red;
            padding:1px;
            box-sizing: border-box;
            font-size: 16px;
            cursor: pointer;
        }
    </style>

<body>

    <div class="header">
        <a href="4 order.php" class="logo"><img src="Images/logo.jpeg" width="60"></a>
        <div>
            <a href="4 order.php"> Home </a>
            <a href="6 contact.php"> Contact </a>
            <a href="7 about.php"> About </a>
            <a href="myorders.php"> My Orders</a>
            <a href="billing.php"> My Cart</a>
            <!-- <a href="4 order.php"> Search </a> -->
            <form method="post" id="logout" action="logout.php">
                <button type="submit" for="logout" name="sub" value="logout" id="logout">Log Out</button>
            </form>
        </div>
    </div>
    <?php
    // session_start();
    include('Conn.php');
    $uname = $_SESSION['uname'];
    $date=date('Y-m-d');
    $sql = 'SELECT * from cart  where uname="' . $uname . '" AND date="'.$date.'"';

    $result = mysqli_query($con, $sql);
    $location;
    if (mysqli_num_rows($result) > 0) {

        echo '<center><h3 id="head">Your orders</h3>';
        echo '<center><table id="create"><th>Product</th><th>Price</th><th>Quantity</th><th>Cost</th><th>Status</th><th>Remove</th>';

        $totalCost=0;
        $flag=1;
        while ($row = mysqli_fetch_assoc($result)) {
            $id=$row["prod_id"];
            $sql1 = "select quantity from products where id='$id'";
            $res1=mysqli_query($con,$sql1);
            $row1=mysqli_fetch_assoc($res1);
            $avail=$row1['quantity'];
            $name=$row["prod_name"];
            $price=$row["price"];
            $quantity=$row["quantity"];
            $cost=$row["cost"];
            $date=$row['date'];
            $location=$row['location'];
            $totalCost+=$cost;
            $status='';
            $color='';
            if($avail>=$quantity){
                $status='Available';
                $color='green';
            }
            else{
                $status='Out of Stock';
                $color='red';
                $flag=0;
            }
            echo "<tr><td> $name </td><td> $price </td><td> $quantity </td><td> $cost </td><td><span style='color:$color'>$status</span></td><form method='post' action='billing_update.php'><td><button id='remove' name='remove' value=$id>Remove</button></td></form></tr>";
        }
        echo '</table></center>';

        echo'<center><p id="p2">Amount to Pay: '.$totalCost.'</p>';
        echo'<p id="p1">Delivery Address: '.$location.'</p>';

        echo '<form id="change" method="post" action="changeAddress.php"><button type="submit" for="change" id="changeaddr" name="sub" value"">Change Delivery Address</button></form>';
        $_SESSION['confirmflag']=$flag;
        echo '<button id="finalpay"><a href="confirm.php" id="pay">Confirm Order</a></button></center>';
        
    } else {
        echo "<center><h3>Nothing left in the cart</h3><center>";
    }

    ?>
</body>

</html>