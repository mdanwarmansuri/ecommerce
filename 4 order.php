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
        .main {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            width: 70%;
            margin: auto;
            /* box-shadow: 2px 2px 2px 2px lightgray; */
            margin-bottom: 30px;
            padding: 5%;
            border-radius: 7px;
            background-color: white;
            border: 2px solid #ccc;
            /* box-sizing: border-box; */
        }

        #txt1 {
            font-size: 20px;
            font-weight: bold;
        }

        #submit {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #prod {
            border-radius: 7px;
            padding: 1.5%;
            width: 70%;
            margin-top: 1%;
        }

        .sub {
            font-size: 20px;
            margin: 1%;
            padding: 2%;
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
            <a class="active" href="4 order.php"> Home </a>
            <a href="6 contact.php"> Contact </a>
            <a href="7 about.php"> About </a>
            <!-- <a class="active" href="4 order.php"> Search </a> -->
            <a href="myorders.php"> My Orders</a>
            <a href="billing.php"> My Cart</a>
            <form method="post" id="logout" action="logout.php">
                <button type="submit" for="logout" name="sub" value="logout" id="logout">Log Out</button>
            </form>
        </div>
    </div>

    <?php

    // session_start();
    include("Conn.php");
    $uname = $_SESSION['uname'];
    $stmt = "select * from user_data where username='$uname'";
    $query = $con->query($stmt);
    $row = $query->fetch_assoc();
    $name = $row['name'];
    echo "<center><h2>Welcome Mr. $name </h2></center>";
    ?>

    <form method="post" id="search" action="searchHandle.php">
        <div class="main">
            <div id="txt1">
                <center>Order Products Online</center>
            </div>
            <div class="sub">
                <div id="txt2">Search for Products</div>
                <div><input type="text" id="prod" name="prod" placeholder="Search for your product here"></div>
            </div>
            <div>
                <center><button type="submit" id="submit" for="search" name="sub" value="Search">Search</button></center>
            </div>
        </div>
    </form>
</body>

</html>