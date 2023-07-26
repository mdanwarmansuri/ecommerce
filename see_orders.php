<?php
include("admin_secure.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>See Orders</title>
    <style>
        #create th,
        tr,
        td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
            background-color:white;
            padding-left: 15px;
            padding-right: 15px;
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
            margin:10px;
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
        width:100%;
        padding:1%;
    }
    #status{
        width:100%;
        padding:1%;
    }
    #updatestatus{
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      margin-top:3%;
    }
    </style>
</head>
<body>
    <?php
    include("admin_header.html");
    ?>
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
    $sql="";
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $date=$_POST['date'];
        $sql="select * from orders where date='$date'";
    }
    else
    $sql = "select * from orders where status!='Delivered' order by date desc";
   
    $result = mysqli_query($con, $sql);
    if ($result && mysqli_num_rows($result) > 0) {

        echo '<center><h3 id="head">Your orders</h3>';
        echo '<center><table id="create"><tr><th>Date</th><th>Costumer</th><th>Contact</th><th>Product</th><th>Price</th><th>Quantity</th><th>Cost</th><th>Delivery Addresss</th><th>Status</th></tr>';
        while ($row = mysqli_fetch_assoc($result)) {
            $id=$row["order_id"];
            $user=$row["user"];
            $mobile=$row["mobile"];
            $name=$row["prod_name"];
            $price=$row["price"];
            $quantity=$row["quantity"];
            $cost=$row["Cost"];
            $date=$row['date'];
            $location=$row['location'];
            $status=$row['status'];
            echo "<tr><td> $date </td><td> $user </td><td> $mobile </td><td> $name </td><td> $price </td><td> $quantity </td><td> $cost </td><td> $location </td><td><form method='post' action='update_status.php'><input type='text' id='status' name='status' placeholder='$status'><br><button type='submit' id='updatestatus' name='submit' value=$id>Click to Update</button> </form></td></tr>";
        }
        echo '</table></center>';
    } else {
        echo "<center><h3>There are no orders</h3><center>";
    }

    ?>
</body>
</html>