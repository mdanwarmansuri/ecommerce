<?php
include("admin_secure.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        .main {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            width: 70%;
            margin: auto;
            /* box-shadow: 2px 2px 2px 2px lightgray; */
            margin-bottom: 30px;
            margin-top: 5%;
            padding: 5%;
            border-radius: 7px;
            background-color: white;
            border:2px solid #ccc;
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
            width: 80%;
            margin-top: 1%;
        }

        .sub {
            font-size: 20px;
            margin: 1%;
            padding: 2%;
        }
        #front{
            margin-top:5%;
            font-size: 24px;
            font-weight: bold;
        }
    </style>
</head>
<?php
include('admin_header.html');
?>

<body>
<center><div id="front"> Admin Panel </div></center>
<form method="post" id="search" action="admin_search.php">
        <div class="main">
            <div id="txt1">
                <center>See and Update Products</center>
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