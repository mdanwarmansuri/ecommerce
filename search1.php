<style>
    #create th,
    tr,
    td {
        border: 1px solid black;
        padding: 5px;
        text-align: center;
    }

    tr {
        color: coral;
    }

    th {
        color: black;
    }

    #paybtn {
        padding: 5px;
        margin: 10px;
    }

    #create th {
        padding: 10px;
        background-color: powderblue;
    }

    #create td {
        background-color: mintcream;
    }
</style>
<?php

?>

<?php

include("Conn.php");
include("4 order.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $uname = $_SESSION["uname"];
    $id = $_POST['add'];

    $quantity = $_POST['quantity'];
    $sql1 = "SELECT * from products where id='$id'";
    $result1 = mysqli_query($con, $sql1);
    $price = 0;
    $date = date("Y-m-d");
    $prod_name = '';
    $avail = 0;
    if ($result1) {
        while ($row1 = mysqli_fetch_assoc($result1)) {
            $price = $row1['price'];
            $prod_name = $row1['name'];
            $avail = $row1['quantity'];
        }
    } else {
        echo "Something went wrong1";
    }
    if ($avail <$quantity) {
        echo "<script>alert('Requested quantity not available')</script>";
    } else {
        //fetching location
        $sql2 = 'SELECT * from address where uname="' . $uname . '"';

        $result2 = mysqli_query($con, $sql2);

        $address;
        if ($result2) {
            while ($row = mysqli_fetch_assoc($result2)) {
                $address = "Pin:" . $row['pin'] . " House no:" . $row['house_no'] . " Area:" . $row['area'] . " Landmark:" . $row['landmark'] . " City:" . $row['city'] . " State:" . $row['state'] . " Addtype:" . $row['addtype'];
            }
        }
        $cost = $price * $quantity;
        $sql3 = "INSERT INTO `cart`(`uname`,`prod_id`,`prod_name`, `price`, `quantity`, `Cost`, `location`, `date`) VALUES('$uname','$id','$prod_name','$price','$quantity','$cost','$address','$date')";

        $result3 = mysqli_query($con, $sql3);

        if ($result3) {
            // $sql4 = "UPDATE products SET quantity=quantity-$quantity WHERE id='$id'";
            // $result4 = mysqli_query($con,$sql4);
            echo '<script>alert("Added to cart successfully")</script>';

        } else {
            echo "Something went wrong2";
        }
    }
}
$prod = $_SESSION["prod"];

$sql = "SELECT *  FROM `products` WHERE `name` LIKE '%$prod%';";
$result = mysqli_query($con, $sql);
if (!$result) {
    echo "<center><h1 style = 'color:red;'> Query failed </h1></center>";
} else {
    if ($result) {
        $num = mysqli_num_rows($result);

        if ($num > 0) {

            echo ('<center><table id="create">');
            echo ('<th> Name of the Product </th>');
            echo ('<th> Price </th>');
            echo ('<th> Image </th>');
            echo ('<th> Available </th>');
            echo ('<th> Quantity </th>');
            echo ('<th> Add to cart </th>');

            $arr = array();
            while ($row =  mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $name = $row['name'];
                $price = $row['price'];
                $path = $row["image"];
                $loc = "Images/$path";
                $avail = $row['quantity'];

                echo ("<tr style = boder: 1px solid>");
                echo "<td>" . $name . "</td>";
                echo "<td> $price </td>";
                echo "<td> <img src = $loc width = 150 height = 150> </td>";
                if($avail>0)
                echo "<td> $avail</td>";
                else
                echo "<td><span style='color:red;'>Out of Stock</span></td>";

                echo '<form method="post" id="add" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">
                    <td> <input type = "number" name = "quantity"> </td>
                    <td><button type="submit" for="add" name="add" id="add" value="' . $id . '"> Click to add </button></form></td>';

                echo "</tr>";
            }
            echo "</table>";

            echo "<form method='post' id='pay' action='billing.php'>
                <button for='pay' type='submit' id='paybtn' >Proceed to Pay</button></form>";
        }
    }
}
?>