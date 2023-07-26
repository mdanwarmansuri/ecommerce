<?php
include("user_secure.php");
?>
<html>
<head>
    <title> Online Shopping - Order </title>
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
            padding: 20px;
            text-align: center;
            background-color:white;
            padding-left: 30px;
            padding-right: 30px;
        }

        #create{
            margin:10px;
            box-sizing: border-box;
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
        #create th{
            background-color:cadetblue;    
        }
        .searchbox{
            width:40%;
            padding:4%;
            margin:auto;
            margin-top:2%;
            border:1px solid #ccc;
            border-radius: 3px;
        }
     input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      padding:2.5% 1%;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      margin-top:2%;
      width:20%;
    }
    #t1{
        font-size: 20px;
        font-weight: bold;
    }
    #t2{
        font-size:18px;
        margin-bottom:1%;
    }
    #date{
        padding:1%;
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
        <a href="1 home.php" class="logo"><img src="Images/logo.jpeg" width="60"></a>
        <div>
            <a href="4 order.php"> Home </a>
            <a href="6 contact.php"> Contact </a>
            <a href="7 about.php"> About </a>
            <a class="active" href="myorders.php"> My Orders</a>
            <a href="billing.php"> My Cart</a>
            <form method="post" id="logout" action="logout.php">
                <button type="submit" for="logout" name="sub" value="logout" id="logout">Log Out</button>
            </form>
        </div>
    </div>
    <div class="searchbox">
        <center><div id="t1">Search by Date</div></center>
        <div id="t2">Enter the date</div>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div><input type="date" name="date" id="date"></div>
        <center><input type="submit" name="submit" value="Search" id="submit"></center>
    </form>
    </div>
    <?php
    // session_start();
    include('Conn.php');
    $uname = $_SESSION['uname'];
    $sql="";
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $date=$_POST['date'];
        $sql="select * from orders where uname='$uname' and date='$date'";
    }
    else
    $sql = "select * from orders where uname='$uname' and status!='Delivered'";

    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {

        echo '<center><h3 id="head">Your orders</h3></center>';
        echo '<center><table id="create"><tr><th>Date</th><th>Medicine</th><th>Price</th><th>Quantity</th><th>Cost</th><th>Delivery Addresss</th><th>Status</th></tr>';

        
        while ($row = mysqli_fetch_assoc($result)) {
            $user=$row["user"];
            $name=$row["prod_name"];
            $price=$row["price"];
            $quantity=$row["quantity"];
            $cost=$row["Cost"];
            $date=$row['date'];
            $location=$row['location'];
            $status=$row['status'];
            echo '<tr><td>'.$date.'</td><td>'.$name.'</td><td>'.$price.'</td><td>'.$quantity.'</td><td>'.$cost.'</td><td>'.$location.'</td><td>'.$status.'</td></tr>';
        }
        echo '</table></center>';
    } else {
        echo "<center><h3>You haven't ordered anything</h3><center>";
    }

    ?>
</body>

</html>