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

    input {
        width: 50%;
    }

    #update {
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }
</style>
<?php
include('Conn.php');
include('admin_panel.php');

$prod = $_POST['prod'];
$sql = "SELECT *  FROM `products` WHERE `name` LIKE '%$prod%';";
$result = mysqli_query($con, $sql);
if (!$result) {
    echo "<center><h1 style = 'color:red;'> Query failed </h1></center>";
} else {
    if ($result) {
        if (mysqli_num_rows($result) > 0) {

            echo ('<center><table id="create">');
            echo ('<th> Name of the Product</th>');
            echo ('<th> Price </th>');
            echo ('<th> Image </th>');
            echo ('<th> Available </th>');
            $arr = array();
            while ($row =  mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $name = $row['name'];
                $price = $row['price'];
                $path = $row["image"];
                $loc = "Images/$path";
                $quant = $row['quantity'];

                echo ("<tr style = boder: 1px solid>");
                echo "<td>" . $name . "</td>";
                echo "<td> $price </td>";
                echo "<td> <img src = $loc width = 100 height = 100> </td>";
                echo "<form method='post' id='add' action='quantity_update.php'><td><input type='number' name='quantity' placeholder='$quant'>
                <br><br> <button value='$id' id='update' name='update'>Click to update</button></td></form>";
                echo "</tr>";
            }
            echo "</table>";
            echo "<form method='post' id='pay' action='billing.php'>
            <button for='pay' type='submit' id='paybtn' >Proceed to Pay</button></form>";
        }
    }
}

?>